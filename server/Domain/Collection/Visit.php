<?php
class Domain_Collection_Visit {

    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_Visit
     */
    private $dataAccess; 

    /**
     * Состояния
     * @var array 
     */
    private $states;
    
    /**
     * Экземпляры
     * @var array
     */
    private $items;
    
    /**
     * Фабрика сообщений
     * @var Domain_Message_Visit_Factory 
     */
    private $messageFactory;
    
    /**
     * Коллекция учеников
     * @var Domain_Collection_Student
     */
    private $studentCollection;


    public function __construct(
        Data_Access_Visit $dataAccess,
        Domain_Message_Visit_Factory $messageFactory,
        Domain_Collection_Student $studentCollection
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->messageFactory = $messageFactory;
        $this->studentCollection = $studentCollection;
        
        $this->states = array();
        $this->items = array();
        
    }
    
    /**
     * Создаёт посещение
     * @return Domain_Visit
     */
    public function create($studentId, $teacherId, $lessonId) {

        $state = $this->dataAccess->create();
        
        $state->setLessonId($lessonId);
        $state->setPartId(null);
        $state->setTeacherId($teacherId);
        $state->setStudentId($studentId);

        $item = $this->make($state);
        
        $this->states[spl_object_hash($item)] = $state;
        $this->items[spl_object_hash($state)] = $item;
        
        return $item;
        
    }
    
    /**
     * Извлекает посещение по ID
     * @param integer $id
     * @return Domain_Visit
     */
    public function readUsingId($id) {
        
        $existingItem = $this->findById($id);
        if ($existingItem !== false) {
            return $existingItem;
        }
        
        $state = $this->dataAccess->readUsingId($id);
        $item = $this->make($state);
        $this->states[spl_object_hash($item)] = $state;
        $this->items[spl_object_hash($state)] = $item;
        return $item;
        
    }
    
    public function readForVisitingStudent($lessonId, $studentId) {
        
        $filter = array('lesson_id' => $lessonId, 'student_id' => $studentId);
        
        $states = $this->dataAccess->readUsingFilter($filter);
        
        if (empty($states)) {
            throw new Domain_Collection_Exception_StudentIsAbsent();
        }
        
        $state = $states[0];
        
        $state instanceof Data_State_Item_Visit;
        
        $existingItem = $this->findById( $state->getId() );
        if ($existingItem !== false) {
            return $existingItem;
        }

        $item = $this->make($state);
        $this->states[spl_object_hash($item)] = $state;
        $this->items[spl_object_hash($state)] = $item;

        return $item;
        
    }
    

    
    public function update($item) {
        $this->dataAccess->update($this->states[spl_object_hash($item)]);
    }
    
    public function delete($item) {
        $this->dataAccess->delete($this->states[spl_object_hash($item)]);
        unset($this->states[spl_object_hash($item)]);
    }
    
    private function findById($id) {
        
        foreach ($this->states as $state) {
            
            $state instanceof Data_State_Item_TrackableInterface;

            if ($state->hasId() && $state->getId() === $id) {
                return $this->items[spl_object_hash($state)];
            }
            
        }
        
        return false;
        
    }
    
    private function make(
        Data_State_Item_Visit $state
    ) {
        
        return new Domain_Visit(
            $state,
            $this->messageFactory,
            $this->studentCollection
         );
        
    }
    
}
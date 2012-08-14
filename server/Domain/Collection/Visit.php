<?php
class Domain_Collection_Visit {

    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_Visit
     */
    private $dataAccess; 
    
    /**
     * Фабрика запросов на идентификацию части урока
     * @var Domain_Message_Factory_PartIdentificationRequest
     */
    private $partIdentificationRequestFactory;
    
    /**
     * Фабрика показа
     * @var Domain_Message_Factory_Presentation
     */
    private $presentationFactory;
    
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

    public function __construct(
        Data_Access_Visit $dataAccess,
        Domain_Message_Factory_PartIdentificationRequest $partIdentificationRequestFactory,
        Domain_Message_Factory_Presentation $presentationFactory
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->partIdentificationRequestFactory = $partIdentificationRequestFactory;
        $this->presentationFactory = $presentationFactory;
        
        $this->states = array();
        $this->items = array();
        
    }
    
    /**
     * Создаёт посещение
     * @return Domain_Visit
     */
    public function create($studentId, $teacherId, $lessonId, $partId) {

        $state = $this->dataAccess->create();
        
        $state->setLessonId($lessonId);
        $state->setPartId($partId);
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

            if ($state->getId() === $id) {
                return $this->items[spl_object_hash($state)];
            }
            
        }
        
        return false;
        
    }
    
    private function make($state) {
        
        return new Domain_Visit(
            $state,
            $this->partIdentificationRequestFactory,
            $this->presentationFactory
         );
        
    }
    
}
<?php
class Domain_Collection_Lesson {

    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_Crud_Lesson 
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
     * Коллекция частей урока
     * @var Domain_Collection_Part
     */
    private $partCollection;
    
    /**
     * Коллекция посещений
     * @var Domain_Collection_Visit
     */
    private $visitCollection;
    
    /**
     * Фабрика запросов на продолжение урока
     * @var Domain_Message_Factory_ContinueRequest
     */
    private $continueRequestFactory;

    /**
     * Фабрика показов уроков
     * @var Domain_Message_Factory_LessonPresentation 
     */
    private $presentationFactory;

    /**
     * Фабрика инспекторов частей урока
     * @var Domain_Message_Factory_PartInspector
     */
    private $partInspectorFactory;
    
    /**
     * Фабрика запросов на изменение части урока
     * @var Domain_Message_Factory_PartUpdateRequest
     */
    private $partUpdateRequestFactory;
    
    public function __construct(
        Data_Access_Lesson $dataAccess,
        Domain_Collection_Part $partCollection,
        Domain_Collection_Visit $visitCollection,
        Domain_Message_Factory_ContinueRequest $continueRequestFactory,
        Domain_Message_Factory_LessonPresentation $presentationFactory,
        Domain_Message_Factory_PartInspector $partInspectorFactory,
        Domain_Message_Factory_PartUpdateRequest $partUpdateRequestFactory
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->partCollection = $partCollection;
        $this->visitCollection = $visitCollection;
        $this->continueRequestFactory = $continueRequestFactory;
        $this->presentationFactory = $presentationFactory;
        $this->partInspectorFactory = $partInspectorFactory;
        $this->partUpdateRequestFactory = $partUpdateRequestFactory;
        
        $this->states = array();
        $this->items = array();
        
    }
    
    /**
     * Создаёт урок
     * @param integer $teacherId
     * @return Domain_Lesson
     */
    public function create($teacherId) {
        
        $state = $this->dataAccess->create();

        $state->setTeacherId($teacherId);
        
        $item = $this->make($state);
        
        $this->states[spl_object_hash($item)] = $state;
        $this->items[spl_object_hash($state)] = $item;
        
        return $item;
        
    }
    
    /**
     * Извлекает урок по ID
     * @param integer $id
     * @return Domain_Lesson
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
    
    public function readUsingFilter($filter) {
        
        $states = $this->dataAccess->readUsingFilter($filter);
        
        $items = array();
        foreach ($states as $state) {
            
            $existingItem = $this->findById( $state->getId() );
            if ($existingItem !== false) {
                $items[] = $existingItem;
            } else {
                $item = $this->make($state);
                $this->states[spl_object_hash($item)] = $state;
                $this->items[spl_object_hash($state)] = $item;
                $items[] = $item;
            }
            
        }

        return $items;
    }
    
    public function readUsingTeacherId($teacherId) {
        
        $states = $this->dataAccess->readUsingTeacherId($teacherId);
        
        $items = array();
        foreach ($states as $state) {
            
            $existingItem = $this->findById( $state->getId() );
            if ($existingItem !== false) {
                $items[] = $existingItem;
            } else {
                $item = $this->make($state);
                $this->states[spl_object_hash($item)] = $state;
                $this->items[spl_object_hash($state)] = $item;
                $items[] = $item;
            }
            
        }

        return $items;
        
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
    
    private function make($state) {
        
        return new Domain_Lesson(
            $state, 
            $this->partCollection,
            $this->visitCollection,
            $this->continueRequestFactory,
            $this->presentationFactory,
            $this->partInspectorFactory,
            $this->partUpdateRequestFactory
        );
        
    }
    
}

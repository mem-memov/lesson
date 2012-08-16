<?php
class Domain_Collection_Teacher {

    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_User 
     */
    private $dataAccess;
    
    /**
     * Коллекция счетов
     * @var Domain_Collection_Account
     */
    private $accountCollection;
    
    /**
     * Коллекция уроков
     * @var Domain_Collection_Lesson
     */
    private $lessonCollection;
    
    /**
     * Фабрика презентационных запросов
     * @var Domain_Message_Factory_PresentationRequest
     */
    private $presentationRequestFactory;
    
    /**
     * Фабрика запросов на получение денег за показ части урока
     * @var Domain_Message_Factory_PartMoneyRequest
     */
    private $partMoneyRequestFactory;
    
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
        Data_Access_Teacher $dataAccess,
        Domain_Collection_Account $accountCollection,
        Domain_Collection_Lesson $lessonCollection,
        Domain_Message_Factory_PresentationRequest $presentationRequestFactory,
        Domain_Message_Factory_PartMoneyRequest $partMoneyRequestFactory
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->accountCollection = $accountCollection;
        $this->lessonCollection = $lessonCollection;
        $this->presentationRequestFactory = $presentationRequestFactory;
        $this->partMoneyRequestFactory = $partMoneyRequestFactory;
        
        $this->states = array();
        $this->items = array();
        
    }
    
    public function create() {
        
        $state = $this->dataAccess->create();
        
        $item = $this->make($state);
        
        $this->states[spl_object_hash($item)] = $state;
        $this->items[spl_object_hash($state)] = $item;
        
        return $item;
        
    }
    
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

    public function readUsingLessonId($lessonId) {
        
        $state = $this->dataAccess->readUsingLessonId($lessonId);
        
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
        
        $this->dataAccess->update( $this->states[spl_object_hash($item)] );
        
    }
    
    public function delete($item) {
        
        $this->dataAccess->delete( $this->states[spl_object_hash($item)] );
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
        
        return new Domain_Teacher(
            $state, 
            $this->accountCollection, 
            $this->lessonCollection,
            $this->presentationRequestFactory,
            $this->partMoneyRequestFactory
        );
        
    }

}

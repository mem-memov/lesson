<?php
class Domain_Collection_Account {

    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_Crud_Teacher 
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
     * Фабрика показов счетов
     * @var Domain_Message_Factory_AccountPresentation 
     */
    private $presentationFactory;

    
    public function __construct(
        Data_Access_Account $dataAccess,
        Domain_Message_Factory_AccountPresentation $presentationFactory
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->presentationFactory = $presentationFactory;
        
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
    
    public function readUsingUserId($userId) {
        
        $state = $this->dataAccess->readUsingUserId($userId);
        
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
    
    private function make(Data_State_Item_Account $state) {
        
        return new Domain_Account(
            $state,
            $this->presentationFactory
        );
        
    }
    
}

<?php
class Domain_Collection_User {

    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_User 
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
     * Коллекция почтовых адресов
     * @var Domain_Collection_Email 
     */
    private $emailCollection;
    
    /**
     * Фабрика инспекторов почтовых адресов
     * @var Domain_Message_Factory_EmailInspector
     */
    private $emailInspectorFactory;

    
    public function __construct(
        Data_Access_User $dataAccess,
        Domain_Collection_Email $emailCollection,
        Domain_Message_Factory_EmailInspector $emailInspectorFactory
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->emailCollection = $emailCollection;
        $this->emailInspectorFactory = $emailInspectorFactory;
        
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
    
    public function readUsingEmail($email) {
        
        $state = $this->dataAccess->readUsingEmail($email);
        
        if (is_null($state)) {
            return $state;
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
        
        return new Domain_User(
            $state,
            $this->emailCollection,
            $this->emailInspectorFactory
        );
        
    }

}

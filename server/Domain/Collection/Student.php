<?php
class Domain_Collection_Student {

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
     * Счета
     * @var array 
     */
    private $accounts;

    
    public function __construct(
        Data_Access_User $dataAccess,
        Domain_Collection_Account $accountCollection
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->accountCollection = $accountCollection;
        
        $this->states = array();
        $this->items = array();
        $this->accounts = array();
        
    }
    
    public function create() {
        
        $state = $this->dataAccess->create();
        $account = $this->accountCollection->create();
        
        $item = $this->make($state,$account);
        
        $this->states[spl_object_hash($item)] = $state;
        $this->items[spl_object_hash($state)] = $item;
        $this->accounts[spl_object_hash($item)] = $account;
        
        return $item;
        
    }
    
    public function readUsingId($id) {
        
        $existingItem = $this->findById($id);
        if ($existingItem !== false) {
            return $existingItem;
        }
        
        
        $state = $this->dataAccess->readUsingId($id);
        $account = $this->accountCollection->readUsingUserId($id);
        
        $item = $this->make($state,$account);
        
        $this->states[spl_object_hash($item)] = $state;
        $this->items[spl_object_hash($state)] = $item;
        $this->accounts[spl_object_hash($item)] = $account;
        
        return $item;
        
    }
    
    public function update($item) {
        
        $this->dataAccess->update( $this->states[spl_object_hash($item)] );
        
        $this->accountCollection->update( $this->accounts[spl_object_hash($item)] );
        
    }
    
    public function delete($item) {
        
        $this->dataAccess->delete( $this->states[spl_object_hash($item)] );
        unset($this->states[spl_object_hash($item)]);
        
        $this->accountCollection->delete( $this->accounts[spl_object_hash($item)] );
        unset($this->accounts[spl_object_hash($item)]);
        
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
    
    private function make($state, $account) {
        
        return new Domain_Student($state, $account);
        
    }

}

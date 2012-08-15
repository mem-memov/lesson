<?php
class Domain_Collection_Student {

    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_Student 
     */
    private $dataAccess;
    
    /**
     * Коллекция счетов
     * @var Domain_Collection_Account
     */
    private $accountCollection;
    
    /**
     * Фабрика запросов на оплату части урока
     * @var Domain_Message_Factory_PartPaymentRequest 
     */
    private $partPaymentRequestFactory;
    
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
        Data_Access_Student  $dataAccess,
        Domain_Collection_Account $accountCollection,
        Domain_Message_Factory_PartPaymentRequest $partPaymentRequestFactory
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->accountCollection = $accountCollection;
        $this->partPaymentRequestFactory = $partPaymentRequestFactory;
        
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
    
    /**
     * 
     * @param type $id
     * @return Domain_Student
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
    
    private function make(Data_State_Item_Student $state) {
        
        return new Domain_Student(
            $state, 
            $this->accountCollection,
            $this->partPaymentRequestFactory
        );
        
    }

}

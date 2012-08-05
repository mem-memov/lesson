<?php
class Domain_Collection_Creator_Teacher {
    
    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_CrudInterface 
     */
    protected $dataAccess;
    
    /**
     * Объект для создания элементов коллекции
     * @var Domain_Collection_Maker_Interface 
     */
    protected $maker;
    
    protected $accountFactory;
    
    public function __construct(
        $dataAccess,
        $maker,
        $accountFactory
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->maker = $maker;
        
    }
    
    public function create() {
        
        $state = $this->dataAccess->create();
        $account = $this->accountFactory->create();
        
        $item = $this->maker->make($state, $account);
        
        $states[spl_object_hash($item)] = $state;
        $accounts[spl_object_hash($item)] = $account;
        
        return $item;
        
    }
    
}
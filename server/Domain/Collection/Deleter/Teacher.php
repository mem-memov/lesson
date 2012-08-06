<?php
class Domain_Collection_Deleter_Teacher implements Domain_Collection_Deleter_Interface {
    
    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_CrudInterface 
     */
    protected $dataAccess;
    
    /**
     * Коллекция счетов
     * @var Domain_Collection_Interface
     */
    protected $accountCollection;
    
    /**
     * Контейнер для состояний учителей
     * @var Domain_Collection_Container_Interface
     */
    protected $stateContainer;
    
    /**
     * Контейнер для счетов учителей
     * @var Domain_Collection_Container_Interface
     */
    protected $accountContainer;
    
    public function __construct(
        Data_Access_CrudInterface $dataAccess,
        Domain_Collection_Interface $accountCollection,
        Domain_Collection_Container_Interface $stateContainer,
        Domain_Collection_Container_Interface $accountContainer
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->accountCollection = $accountCollection;
        $this->stateContainer = $stateContainer;
        $this->accountContainer = $accountContainer;
        
    }
    
    public function delete($item) {
        
        $this->dataAccess->delete( $this->stateContainer->get($item) );
        $this->stateContainer->remove($item);
        
        $this->accountCollection->delete( $this->accountContainer->get($item) );
        $this->accountContainer->remove($item);
        
    }
    
}
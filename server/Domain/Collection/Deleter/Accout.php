<?php
class Domain_Collection_Deleter_Account implements Domain_Collection_Deleter_Interface {
    
    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_CrudInterface 
     */
    protected $dataAccess;
    
    /**
     * Контейнер для состояний счетов
     * @var Domain_Collection_Container_Interface
     */
    protected $stateContainer;
    
    public function __construct(
        Data_Access_CrudInterface $dataAccess,
        Domain_Collection_Container_Interface $accountContainer
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->stateContainer = $stateContainer;
        
    }
    
    public function delete($item) {
        
        $this->dataAccess->delete( $this->stateContainer->get($item) );
        $this->stateContainer->remove($item);
        
    }
    
}
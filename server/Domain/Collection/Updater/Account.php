<?php
class Domain_Collection_Updater_Account implements Domain_Collection_Updater_Interface {
    
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
        Domain_Collection_Container_Interface $stateContainer
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->stateContainer = $stateContainer;
        
    }
    
    public function update($item) {
        
        $this->dataAccess->update( $this->stateContainer->get($item) );
        
    }
    
}
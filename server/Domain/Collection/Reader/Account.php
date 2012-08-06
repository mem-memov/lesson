<?php
class Domain_Collection_Reader_Account implements Domain_Collection_Reader_Interface {
    
    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_CrudInterface 
     */
    protected $dataAccess;
    
    /**
     * Объект для создания элементов данной коллекции
     * @var Domain_Collection_Constructor_Interface
     */
    protected $constructor;
    
    /**
     * Контейнер для состояний счетов
     * @var Domain_Collection_Container_Interface
     */
    protected $stateContainer;

    
    public function __construct(
        Data_Access_CrudInterface $dataAccess,
        Domain_Collection_Constructor_Interface $constructor,
        Domain_Collection_Container_Interface $stateContainer
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->constructor = $constructor;
        $this->stateContainer = $stateContainer;
        
    }
    
    public function readUsingId($id) {
        
        $state = $this->dataAccess->create();
        
        $item =  $this->constructor->construct($state);
        
        $this->stateContainer->add($item, $state);
        
        return $item;
        
    }
    
}
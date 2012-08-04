<?php
abstract class Data_Access_Crud_Abstract implements Data_Access_Crud_Interface {
    
    /**
     * Фабрика состояний
     * @var Data_Sate_Factory_Interface
     */
    protected $stateFactory;
    
    /**
     * Хранилище
     * @var Service_Storage_Interface
     */
    protected $storage;

    public function __construct(
        Data_Sate_Factory_Interface $stateFactory,
        Service_Storage_Interface $storage
    ) {
        
        $this->stateFactory = $stateFactory;
        $this->storage = $storage;
        
    }
    
}

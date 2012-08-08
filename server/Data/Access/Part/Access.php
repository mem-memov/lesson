<?php
/**
 * Доступ к частям урока
 */
class Data_Access_Part_Access {
    
    /**
     * Фабрика состояний
     * @var Data_State_Factory_Interface
     */
    protected $stateFactory;
    
    /**
     * Хранилище
     * @var Service_Storage_Interface
     */
    protected $storage;

    public function __construct(
        Data_State_Factory_Interface $stateFactory,
        Service_Storage_Interface $storage
    ) {
        
        $this->stateFactory = $stateFactory;
        $this->storage = $storage;
        
    }
    
    /**
     * Создаёт состояние части урока
     * @return 
     */
    public function create($type) {
        
        return $this->stateFactory->makeState($type);

    }
    
}
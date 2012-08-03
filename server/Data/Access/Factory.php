<?php
/**
 * Фабрика объектов доступа к двнным
 */
class Data_Access_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;
    
    /**
     * Хранилище данных
     *
     * @var Service_Storage_Interface 
     */
    private $storage;
    
    /**
     * Фабрика состояний
     *
     * @var Data_State_Factory
     */
    private $stateFactory;
    
    /**
     * Создаёт экземпляр класса
     */
    public function __construct(
        Service_Storage_Interface $storage,
        Data_State_Factory $stateFactory
    ) {
        
        $this->storage = $storage;
        
        $this->stateFactory = $stateFactory;

        $this->uniqueInstances = array();

    }
    
    public function makeAccess() {
        
    }

    
    
}
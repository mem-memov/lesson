<?php
class Data_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;

    /**
     * Настройки доступа к данным
     *
     * @var array
     */
    private $configuration;
    
    /**
     * Хранилище данных
     *
     * @var Service_Storage_Interface 
     */
    private $storage;

    /**
     * Создаёт экземпляр класса
     *
     * @param array $configuration
     */
    public function __construct(
        array $configuration,
        Service_Storage_Interface $storage
    ) {

        $this->uniqueInstances = array();
        $this->configuration = $configuration;
        $this->storage = $storage;

    }
    
    /**
     * Создаёт фабрику объектов доступа к данным (DAO)
     * @return Data_Access_Factory 
     */
    public function makeAccessFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Factory(
                $this->storage,
                $this->makeStateFactory()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    /**
     * Создаёт фабрику фабрик состояний
     * @return Data_State_FactoryInterface
     */
    public function makeStateFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_State_Factory(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }

}
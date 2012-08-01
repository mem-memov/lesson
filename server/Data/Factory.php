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
     *
     * @return Data_Access_Factory 
     */
    public function makeAccessFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Access_Factory(
                $this->storage,
                $this->makeTypeFactory()
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }
    
    /**
     *
     * @return Data_Type_Factory
     */
    public function makeTypeFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->uniqueInstances[$instance_key])) {
            $this->uniqueInstances[$instance_key] = new Data_Type_Factory(
                
            );
        }

        return $this->uniqueInstances[$instance_key];
        
    }

    
}
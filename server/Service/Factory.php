<?php
/**
 * Фабрика сервисов 
 */
class Service_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;

    /**
     * Настройки сервисов
     *
     * @var array
     */
    private $configuration;

    /**
     * Создаёт экземпляр класса
     *
     * @param array $configuration
     */
    public function __construct(
        array $configuration
    ) {

        $this->uniqueInstances = array();
        $this->configuration = $configuration;

    }
    
    public function makeStorage() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            
            $storageFactory = $this->makeStorageFactory();
            
            $this->instances[$instance_key] = $storageFactory->makeMysqlStorage('', '', '', '');
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     *
     * @return Service_Storage_Factory 
     */
    private function makeStorageFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            
            $this->instances[$instance_key] = new Service_Storage_Factory(
                $this->configuration['Storage']
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
}
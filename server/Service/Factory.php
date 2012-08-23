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
        
                
        //TODO: убрать развёртывание таблиц в базе данных
        $this->makeInstaller()->install();

    }
    
    /**
     * 
     * @return Service_Storage_Interface
     */
    public function makeStorage() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            
            $storageFactory = $this->makeStorageFactory();
            
            $configuration = $this->configuration['Storage']['Mysql'];
            
            $this->instances[$instance_key] = $storageFactory->makeMysqlStorage(
                $configuration['server'], 
                $configuration['user'], 
                $configuration['password'], 
                $configuration['database']
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * 
     * @return Service_Authentication_Interface
     */
    public function makeAuthentication() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            
            $authenticationFactory = $this->makeAuthenticationFactory();
            
            $this->instances[$instance_key] = $authenticationFactory->makeHybridAuthAdapter();
            
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
    
    /**
     *
     * @return Service_Installer_Mysql_Installer
     */
    private function makeInstaller() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            
            $this->instances[$instance_key] = new Service_Installer_Mysql_Installer(
                $this->makeStorage()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     *
     * @return Service_Authentication_Factory 
     */
    private function makeAuthenticationFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            
            $this->instances[$instance_key] = new Service_Authentication_Factory(
                $this->configuration['Authentication']
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     *
     * @return Service_Mail_Factory
     */
    private function makeAuthenticationFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            
            $this->instances[$instance_key] = new Service_Mail_Factory(
                $this->configuration['Mail']
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    

    
}
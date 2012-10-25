<?php
/**
 * Фабрика хранилищ
 */
class Service_Authentication_Factory {
    
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
    
    public function makeHybridAuthAdapter() {
        
        return new Service_Authentication_HybridAuth_Adapter(
            $this->makeHybridAuth() 
        );
        
    }
    
    private function makeHybridAuth() {
        
        require_once( dirname(__FILE__).'/HybridAuth/hybridauth-2.0.11/hybridauth/Hybrid/Auth.php' );

        return new Hybrid_Auth( $this->configuration['HybridAuth'] );
        
    }
    
}

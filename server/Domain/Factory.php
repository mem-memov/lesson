<?php
/**
 * Фабрика слоя модели предметной области 
 */
class Domain_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;

    /**
     * Настройки модели
     *
     * @var array
     */
    private $configuration;
    
    /**
     * Фабрика слоя данных
     * 
     * @var Data_Factory
     */
    private $dataFactory;
    
    /**
     * Фабрика слоя сервисов
     * 
     * @var Service_Factory
     */
    private $serviceFactory;

    /**
     * Создаёт экземпляр класса
     *
     * @param array $configuration
     */
    public function __construct(
        array $configuration,
        Data_Factory $dataFactory,
        Service_Factory $serviceFactory
    ) {

        $this->uniqueInstances = array();
        $this->configuration = $configuration;
        $this->dataFactory = $dataFactory;
        $this->serviceFactory = $serviceFactory;

    }
    
 
    
}
<?php
/**
 * Фабрика сетевых дисков
 */
class Service_WebDisk_Factory {
    
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

    
}
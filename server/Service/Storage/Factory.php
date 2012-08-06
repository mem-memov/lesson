<?php
/**
 * Фабрика хранилищ
 */
class Service_Storage_Factory {
    
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
    
    public function makeMysqlStorage($server, $user, $password, $database) {
        
        return new Service_Storage_Mysql_Adapter($server, $user, $password, $database);
        
    }
    
}

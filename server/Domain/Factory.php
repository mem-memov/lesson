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
    
    /**
     * Создаёт школу
     * @return Domain_School
     */
    public function makeSchool() {
        
        $collectionFactory = $this->makeCollectionFactory();
        $messageFactory = $this->makeMessageFactory();
        
        return new Domain_School(
            $collectionFactory->makeTeacherCollection(),
            $collectionFactory->makeLessonCollection(),
            $messageFactory->makeEducationRequestFactory()
        );
        
    }
    
    /**
     * Создаёт фабрику коллекций
     * @return Domain_Collection_Factory
     */
    private function makeCollectionFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Factory(
                $this->dataFactory->makeAccessFactory(),
                $this->makeMessageFactory()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт фабрику, создающую фабрики сообщений
     * @return Domain_Message_Factory
     */
    private function makeMessageFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Factory(
                
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
}
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
        
        return new Domain_School(
            $collectionFactory->makeLessonCollection(),
            $collectionFactory->makeStudentCollection(),
            $collectionFactory->makeTeacherCollection()
        );
        
    }
    
    /**
     * Создаёт фабрику коллекций
     * @return Domain_Collection_FactoryInterface
     */
    private function makeCollectionFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Factory(
                $this->dataFactory->makeAccessFactory()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
}
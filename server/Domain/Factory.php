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
                $this->makeContainerFactory(),
                $this->makeCreatorFactory(),
                $this->makeReaderFactory(),
                $this->makeUpdaterFactory(),
                $this->makeDeleterFactory()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * 
     * @return Domain_Collection_Container_FactoryInterface
     */
    private function makeContainerFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Container_Factory(
                
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * 
     * @return Domain_Collection_Creator_FactoryInterface
     */
    private function makeCreatorFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Creator_Factory(
                
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * 
     * @return Domain_Collection_Reader_FactoryInterface
     */
    private function makeReaderFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Reader_Factory(
                
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * 
     * @return Domain_Collection_Updater_FactoryInterface
     */
    private function makeUpdaterFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Updater_Factory(
                
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * 
     * @return Domain_Collection_Deleter_FactoryInterface
     */
    private function makeDeleterFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Deleter_Factory(
                
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
}
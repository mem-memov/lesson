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
     * Создаёт охранника
     * @return Domain_Guard
     */
    public function makeGuard() {
        
        $collectionFactory = $this->makeCollectionFactory();
        $messageFactory = $this->makeMessageFactory();
        $collaboratorFactory = $this->makeCollaboratorFactory();
        
        return new Domain_Guard(
            $this->serviceFactory->makeAuthentication(),
            $collectionFactory->makeUserCollection(),
            $collaboratorFactory->makeEmailActivationFactory(),
            $messageFactory->makeMailReceptionRequestFactory(),
            $messageFactory->makeEnrollmentReportFactory(),
            $messageFactory->makeEmailConfirmationRequestFactory(),
            $messageFactory->makeEmailActivationReportFactory()
        );
        
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
            $collectionFactory->makeStudentCollection(),
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
                $this->serviceFactory,
                $this->makeMessageFactory(),
                $this->makeCollaboratorFactory()
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
    
    /**
     * Создаёт фабрику, создающую фабрики помошников
     * @return Domain_Collaborator_Factory
     */
    private function makeCollaboratorFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collaborator_Factory(
                
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
}
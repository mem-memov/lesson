<?php
class Domain_Collection_Factory {
    
    /**
     * Контейнер для уникальных объектов
     * @var array
     */
    private $uniqueInstances;
    
    /**
     * Фабрика объектов доступа к данным
     * @var Data_Access_Factory 
     */
    private $accessFactory;
    
    /**
     * Фабрика, создающая фабрики сообщений
     * @var Domain_Message_Factory
     */
    private $messageFactory;

    public function __construct(
        Data_Access_Factory $accessFactory,
        Domain_Message_Factory $messageFactory
    ) {

        $this->accessFactory = $accessFactory;
        $this->messageFactory = $messageFactory;
        
        $this->uniqueInstances = array();
        
    }
    
    /**
     * Создаёт коллекцию денежных счетов
     * @return Domain_Collection_Account
     */
    public function makeAccountCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Account(
                $this->accessFactory->makeAccount(),
                $this->messageFactory->makeAccountPresentationFactory()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт коллекцию уроков
     * @return Domain_Collection_Lesson
     */
    public function makeLessonCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Lesson(
                $this->accessFactory->makeLesson(),
                $this->makePartCollection(),
                $this->makeVisitCollection(),
                $this->messageFactory->makeContinueRequestFactory(),
                $this->messageFactory->makeVisitRequestFactory(),
                $this->messageFactory->makeLessonPresentationFactory(),
                $this->messageFactory->makePartInspectorFactory(),
                $this->messageFactory->makePartUpdateRequestFactory()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт коллекцию учеников
     * @return Domain_Collection_Student
     */
    public function makeStudentCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Student(
                $this->accessFactory->makeStudent(),
                $this->makeAccountCollection(),
                $this->messageFactory->makePartPaymentRequestFactory()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт коллекцию учителей
     * @return Domain_Collection_Teacher
     */
    public function makeTeacherCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Teacher(
                $this->accessFactory->makeTeacher(),
                $this->makeAccountCollection(),
                $this->makeLessonCollection(),
                $this->messageFactory->makePresentationRequestFactory()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт коллекцию частей урока
     * @return Domain_Collection_Part
     */
    public function makePartCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Part(
                $this->accessFactory->makePart(),
                $this->makeTextCollection(),
                $this->makeVisitCollection(),
                $this->messageFactory->makePartPresentationFactory(),
                $this->messageFactory->makePartAnnouncementFactory(),
                $this->messageFactory->makePartJoinCallFactory(),
                $this->messageFactory->makePartUpdateRequestFactory()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт коллекцию текстовых учебных пособий
     * @return Domain_Collection_Text
     */
    public function makeTextCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Text(
                $this->accessFactory->makeText(),
                $this->messageFactory->makeTextPresentationFactory()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт коллекцию посещений уроков
     * @return Domain_Collection_Visit
     */
    public function makeVisitCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Visit(
                $this->accessFactory->makeVisit(),
                $this->makeStudentCollection(),
                $this->messageFactory->makePartIdentificationRequestFactory(),
                $this->messageFactory->makePresentationFactory(),
                $this->messageFactory->makeLearnRequestFactory()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    

    
}
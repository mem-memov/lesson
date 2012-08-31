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
     * Фабрика слоя сервисов
     * 
     * @var Service_Factory
     */
    private $serviceFactory;
    
    /**
     * Фабрика, создающая фабрики сообщений
     * @var Domain_Message_Factory
     */
    private $messageFactory;
    
    /**
     * Фабрика, создающая фабрики помошников
     * @var Domain_Collaborator_Factory
     */
    private $collaboratorFactory;

    public function __construct(
        Data_Access_Factory $accessFactory,
        Service_Factory $serviceFactory,
        Domain_Message_Factory $messageFactory,
        Domain_Collaborator_Factory $collaboratorFactory
    ) {

        $this->accessFactory = $accessFactory;
        $this->serviceFactory = $serviceFactory;
        $this->messageFactory = $messageFactory;
        $this->collaboratorFactory = $collaboratorFactory;
        
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
                $this->messageFactory->makeAccountMessageFactory()
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
                $this->messageFactory->makeLessonMessageFactory(),
                $this->makePartCollection(),
                $this->makeVisitCollection()
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
                $this->messageFactory->makeStudentMessageFactory(),
                $this->makeAccountCollection()
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
                $this->messageFactory->makeTeacherMessageFactory(),
                $this->makeAccountCollection(),
                $this->makeLessonCollection()
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
                $this->messageFactory->makePartMessageFactory(),
                $this->makeTextCollection(),
                $this->makeVisitCollection()
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
                $this->messageFactory->makeTextMessageFactory()
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
                $this->messageFactory->makeVisitMessageFactory(),
                $this->makeStudentCollection()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт коллекцию пользователей
     * @return Domain_Collection_User
     */
    public function makeUserCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_User(
                $this->accessFactory->makeUser(),
                $this->messageFactory->makeUserMessageFactory(),
                $this->makeEmailCollection(),
                $this->collaboratorFactory->makeEmailActivationFactory()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт коллекцию почтовых адресов
     * @return Domain_Collection_Email
     */
    public function makeEmailCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Email(
                $this->accessFactory->makeEmail(),
                $this->messageFactory->makeEmailMessageFactory()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    

    
}
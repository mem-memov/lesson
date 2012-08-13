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
    
    public function makeAccountCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Account(
                $this->accessFactory->makeAccount()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    public function makeLessonCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Lesson(
                $this->accessFactory->makeLesson(),
                $this->makePartCollection(),
                $this->makeVisitCollection(),
                $this->messageFactory->makeContinueRequestFactory(),
                $this->messageFactory->makeVisitRequestFactory()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    public function makeStudentCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Student(
                $this->accessFactory->makeUser(),
                $this->makeAccountCollection()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
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
    
    public function makePartCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Part(
                $this->accessFactory->makePart(),
                $this->makeTextCollection(),
                $this->makeVisitCollection()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    public function makeTextCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Text(
                $this->accessFactory->makeText()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    public function makeVisitCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Visit(
                $this->accessFactory->makeVisit(),
                $this->messageFactory->makePartIdentificationRequestFactory()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    

    
}
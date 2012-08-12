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

    public function __construct(
        Data_Access_Factory $accessFactory
    ) {

        $this->accessFactory = $accessFactory;
        
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
                $this->makePartCollection()
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
                $this->accessFactory->makeUser(),
                $this->makeAccountCollection(),
                $this->makeLessonCollection()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    public function makePartCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Part(
                $this->accessFactory->makePart(),
                $this->makeTextCollection()
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
                $this->accessFactory->makeVisit()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    

    
}
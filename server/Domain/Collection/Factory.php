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
                $this->accessFactory->makeLesson()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    public function makeStudentCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Student(
                $this->accessFactory->makeStudent(),
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
                $this->makeAccountCollection()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    

    
}
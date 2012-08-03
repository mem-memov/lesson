<?php
class Data_State_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;

    /**
     * Создаёт экземпляр класса
     *
     * @param array $configuration
     */
    public function __construct() {

        $this->uniqueInstances = array();

    }
    
    /**
     *
     * @return Data_State_AccountFactory 
     */
    public function makeAccountFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Data_State_Account_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     *
     * @return Data_State_LessonFactory 
     */
    public function makeLessonFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Data_State_Lesson_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     *
     * @return Data_State_StudentFactory 
     */
    public function makeStudentFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Data_State_Student_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     *
     * @return Data_State_TeacherFactory 
     */
    public function makeTeacherFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Data_State_Teacher_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }
    
}

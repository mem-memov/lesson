<?php
class Domain_Collection_Constructor_Factory 
implements 
    Domain_Collection_Constructor_FactoryInterface 
{
    
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
    public function __construct(
        
    ) {

        $this->uniqueInstances = array();

    }
    
    public function makeAccount() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Constructor_Account(
                    
            );
            
        }

        return $this->instances[$instance_key];

    }
    
    public function makeLesson() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Constructor_Lesson(
                    
            );
            
        }

        return $this->instances[$instance_key];

    }
    
    public function makeStudent() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Constructor_Student(
                    
            );
            
        }

        return $this->instances[$instance_key];

    }
    
    public function makeTeacher() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Constructor_Teacher(
                    
            );
            
        }

        return $this->instances[$instance_key];

    }

}
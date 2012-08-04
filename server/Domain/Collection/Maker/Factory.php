<?php
class Domain_Collection_Maker_Factory 
implements 
    Domain_Collection_Maker_FactoryInterface 
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

            $this->instances[$instance_key] = new Domain_Collection_Maker_Account(
                    
            );
            
        }

        return $this->instances[$instance_key];

    }
    
    public function makeLesson() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Maker_Lesson(
                    
            );
            
        }

        return $this->instances[$instance_key];

    }
    
    public function makeStudent() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Maker_Student(
                    
            );
            
        }

        return $this->instances[$instance_key];

    }
    
    public function makeTeacher() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Maker_Teacher(
                    
            );
            
        }

        return $this->instances[$instance_key];

    }

}
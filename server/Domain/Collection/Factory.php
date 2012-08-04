<?php
class Domain_Collection_Factory 
implements
    Domain_Collection_FactoryInterface
{
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;
    
    /**
     *
     * @var Domain_Collection_Maker_FactoryInterface
     */
    private $makerFactory;

    /**
     * Создаёт экземпляр класса
     *
     * @param array $configuration
     */
    public function __construct(
        Domain_Collection_Maker_FactoryInterface $makerFactory
    ) {

        $this->makerFactory = $makerFactory;
        
        $this->uniqueInstances = array();
        
    }
    
    public function makeAccountCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Base(
                $this->makerFactory->makeAccount()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    public function makeLessonCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Base(
                $this->makerFactory->makeLesson()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    public function makeStudentCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Base(
                $this->makerFactory->makeStudent()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    public function makeTeacherCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Teacher(
                $this->makerFactory->makeTeacher()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    

    
}
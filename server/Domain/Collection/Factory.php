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
    
    private $containerFactory;
    private $creatorFactory;
    private $readerFactory;
    private $updaterFactory;
    private $deleterFactory;

    /**
     * Создаёт экземпляр класса
     */
    public function __construct(
        Domain_Collection_Container_FactoryInterface $containerFactory,
        Domain_Collection_Creator_FactoryInterface $creatorFactory,
        Domain_Collection_Reader_FactoryInterface $readerFactory,
        Domain_Collection_Updater_FactoryInterface $updaterFactory,
        Domain_Collection_Deleter_FactoryInterface $deleterFactory
    ) {

        $this->containerFactory = $containerFactory;
        $this->creatorFactory = $creatorFactory;
        $this->readerFactory = $readerFactory;
        $this->updaterFactory = $updaterFactory;
        $this->deleterFactory = $deleterFactory;
        
        $this->uniqueInstances = array();
        
    }
    
    public function makeAccountCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Base(
                $this->creatorFactory->makeAccount(),
                $this->readerFactory->makeAccount(),
                $this->updaterFactory->makeAccount(),
                $this->deleterFactory->makeAccount()
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
                $this->creatorFactory->makeStudent(),
                $this->readerFactory->makeStudent(),
                $this->updaterFactory->makeStudent(),
                $this->deleterFactory->makeStudent()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    
    public function makeTeacherCollection() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Collection_Teacher(
                $this->creatorFactory->makeTeacher(),
                $this->readerFactory->makeTeacher(),
                $this->updaterFactory->makeTeacher(),
                $this->deleterFactory->makeTeacher(),
                $this->readerFactory->makeTeacherUsingLessinId()
            );
            
        }

        return $this->instances[$instance_key];
        
    }
    

    
}
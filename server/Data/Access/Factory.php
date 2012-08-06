<?php
/**
 * Фабрика объектов доступа к двнным
 */
class Data_Access_Factory implements Data_Access_FactoryInterface {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;
    
    /**
     * Хранилище данных
     *
     * @var Service_Storage_Interface 
     */
    private $storage;
    
    /**
     * Фабрика состояний
     *
     * @var Data_State_FactoryInterface
     */
    private $stateFactory;
    
    /**
     * Фабрика реализаций CRUD-интерфейса
     *
     * @var Data_Access_Crud_FactoryInterface
     */
    private $crudFactory;
    
    /**
     * Создаёт экземпляр класса
     */
    public function __construct(
        Service_Storage_Interface $storage,
        Data_State_FactoryInterface $stateFactory,
        Data_Access_Crud_FactoryInterface $crudFactory
    ) {
        
        $this->storage = $storage;
        
        $this->stateFactory = $stateFactory;
        
        $this->crudFactory = $crudFactory;

        $this->uniqueInstances = array();

    }
    
    public function makeAccount() {

        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            
            $this->instances[$instance_key] = new Data_Access_Base(
                $this->crudFactory->makeAccount()
            );
            
        }

        return $this->instances[$instance_key];
        
    }

    public function makeLesson() {

        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            
            $this->instances[$instance_key] = new Data_Access_Base(
                $this->crudFactory->makeLesson()
            );
            
        }

        return $this->instances[$instance_key];
        
    }

    public function makeStudent() {

        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            
            $this->instances[$instance_key] = new Data_Access_Base(
                $this->crudFactory->makeStudent()
            );
            
        }

        return $this->instances[$instance_key];
        
    }

    public function makeTeacher() {

        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            
            $this->instances[$instance_key] = new Data_Access_Base(
                $this->crudFactory->makeTeacher()
            );
            
        }

        return $this->instances[$instance_key];
        
    }

    
    
}
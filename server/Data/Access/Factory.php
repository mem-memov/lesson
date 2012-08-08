<?php
/**
 * Фабрика объектов доступа к двнным
 */
class Data_Access_Factory {
    
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
     * Создаёт экземпляр класса
     */
    public function __construct(
        Service_Storage_Interface $storage,
        Data_State_Factory $stateFactory
    ) {
        
        $this->storage = $storage;
        
        $this->stateFactory = $stateFactory;

        $this->uniqueInstances = array();

    }
    
    public function makeAccount() {

        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            
            $this->instances[$instance_key] = new Data_Access_Account(
                $this->stateFactory->makeAccountFactory(),
                $this->storage
            );
            
        }

        return $this->instances[$instance_key];
        
    }

    public function makeLesson() {

        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            
            $this->instances[$instance_key] = new Data_Access_Lesson(
                $this->stateFactory->makeLessonFactory(),
                $this->storage
            );
            
        }

        return $this->instances[$instance_key];
        
    }

    public function makeUser() {

        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            
            $this->instances[$instance_key] = new Data_Access_User(
                $this->stateFactory->makeUserFactory(),
                $this->storage
            );
            
        }

        return $this->instances[$instance_key];
        
    }

    public function makePartText() {

        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {
            
            $this->instances[$instance_key] = new Data_Access_PartText(
                $this->stateFactory->makePartTextFactory(),
                $this->storage
            );
            
        }

        return $this->instances[$instance_key];
        
    }

}
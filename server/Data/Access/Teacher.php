<?php
class Data_Access_Teacher {
    
    /**
     * Фабрика состояний
     * @var Data_State_Factory_Interface
     */
    protected $stateFactory;
    
    /**
     * Хранилище
     * @var Service_Storage_Interface
     */
    protected $storage;

    public function __construct(
        Data_State_Factory_Interface $stateFactory,
        Service_Storage_Interface $storage
    ) {
        
        $this->stateFactory = $stateFactory;
        $this->storage = $storage;
        
    }
    
    /**
     * Создаёт состояние учителя
     * @return Data_State_Lesson_Item
     */
    public function create() {
        
        return $this->stateFactory->makeState();

    }
    
    /**
     * 
     * @param integer $lessonId
     * @return Data_State_Teacher_Item
     */
    public function readUsingLessonId($lessonId) {
        
        return $item;
        
    }
    
}
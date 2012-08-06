<?php
class Data_Access_Teacher extends Data_Access_Base {
    
    /**
     * Фабрика состояний
     * @var Data_Sate_Factory_Interface
     */
    protected $stateFactory;
    
    /**
     * Хранилище
     * @var Service_Storage_Interface
     */
    protected $storage;

    public function __construct(
        Data_Sate_Factory_Interface $stateFactory,
        Service_Storage_Interface $storage
    ) {
        
        $this->stateFactory = $stateFactory;
        $this->storage = $storage;
        
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
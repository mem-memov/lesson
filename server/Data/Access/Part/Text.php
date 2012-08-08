<?php
/**
 * Доступ к текстовым частям урока
 */
class Data_Access_Part_Text {
    
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
     * Создаёт состояние части урока
     * @return Data_State_Item_Part_Text|
     */
    public function create() {
        
        return $this->stateFactory->makeState();

    }
    
}
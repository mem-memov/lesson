<?php
abstract class Data_Access_Abstract implements Data_Access_CrudInterface {
    
    /**
     * Фабрика состояний
     * @var Data_Sate_StateFactoryInterface
     */
    protected $stateFactory;
    
    /**
     * Хранилище
     * @var Service_Storage_Interface
     */
    protected $storage;

    public function __construct(
        Data_Sate_StateFactoryInterface $stateFactory,
        Service_Storage_Interface $storage
    ) {
        
        $this->stateFactory = $stateFactory;
        $this->storage = $storage;
        
    }
    
    abstract public function create();
    
    abstract public function readUsingId($id);
    
    abstract public function update(Data_State_TrackableInterface $state);
    
    abstract public function delete(Data_State_TrackableInterface $state);
    
}

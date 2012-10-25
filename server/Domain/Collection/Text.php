<?php
class Domain_Collection_Text {

    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_Text
     */
    private $dataAccess; 
    
    /**
     * Состояния
     * @var array 
     */
    private $states;
    
    /**
     * Экземпляры
     * @var array
     */
    private $items;
    
    /**
     * Фабрика сообщений
     * @var Domain_Message_Text_Factory 
     */
    private $messageFactory;
    
    public function __construct(
        Data_Access_Text $dataAccess,
        Domain_Message_Text_Factory $messageFactory
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->messageFactory = $messageFactory;
        
        $this->states = array();
        $this->items = array();
        
    }
    
    /**
     * Создаёт текст
     * @param string $text
     * @return Domain_Text
     */
    public function create($text) {
        
        $state = $this->dataAccess->create();
        
        $state->setText($text);
        
        $item = $this->make($state);
        
        $this->states[spl_object_hash($item)] = $state;
        $this->items[spl_object_hash($state)] = $item;
        
        return $item;
        
    }
    
    /**
     * Извлекает текст по ID
     * @param integer $id
     * @return Domain_Text
     */
    public function readUsingId($id) {
        
        $existingItem = $this->findById($id);
        if ($existingItem !== false) {
            return $existingItem;
        }
        
        $state = $this->dataAccess->readUsingId($id);
        $item = $this->make($state);
        $this->states[spl_object_hash($item)] = $state;
        $this->items[spl_object_hash($state)] = $item;
        return $item;
        
    }
    
    public function update($item) {
        $this->dataAccess->update($this->states[spl_object_hash($item)]);
    }
    
    public function delete($item) {
        $this->dataAccess->delete($this->states[spl_object_hash($item)]);
        unset($this->states[spl_object_hash($item)]);
    }
    
    private function findById($id) {
        
        foreach ($this->states as $state) {
            
            $state instanceof Data_State_Item_TrackableInterface;

            if ($state->hasId() && $state->getId() === $id) {
                return $this->items[spl_object_hash($state)];
            }
            
        }
        
        return false;
        
    }
    
    private function make($state) {
        
        return new Domain_Text(
            $state,
            $this->messageFactory
        );
        
    }
    
}
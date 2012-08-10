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

    
    public function __construct(
        Data_Access_Text $dataAccess
    ) {
        
        $this->dataAccess = $dataAccess;
        
        $this->states = array();
        
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
        
        return $item;
        
    }
    
    /**
     * Извлекает текст по ID
     * @param integer $id
     * @return Domain_Text
     */
    public function readUsingId($id) {
        $state = $this->dataAccess->readUsingId($id);
        $item = $this->make($state);
        $this->states[spl_object_hash($item)] = $state;
        return $item;
    }
    
    public function update($item) {
        $this->dataAccess->update($this->states[spl_object_hash($item)]);
    }
    
    public function delete($item) {
        $this->dataAccess->delete($this->states[spl_object_hash($item)]);
        unset($this->states[spl_object_hash($item)]);
    }
    
    private function make($state) {
        
        return new Domain_Text($state);
        
    }
    
}
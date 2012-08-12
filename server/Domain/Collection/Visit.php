<?php
class Domain_Collection_Visit {

    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_Visit
     */
    private $dataAccess; 
    
    /**
     * Состояния
     * @var array 
     */
    private $states;

    
    public function __construct(
        Data_Access_Visit $dataAccess
    ) {
        
        $this->dataAccess = $dataAccess;
        
        $this->states = array();
        
    }
    
    /**
     * Создаёт посещение
     * @return Domain_Visit
     */
    public function create() {
        
        $state = $this->dataAccess->create();

        $item = $this->make($state);
        
        $this->states[spl_object_hash($item)] = $state;
        
        return $item;
        
    }
    
    /**
     * Извлекает посещение по ID
     * @param integer $id
     * @return Domain_Visit
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
        
        return new Domain_Visit($state);
        
    }
    
}
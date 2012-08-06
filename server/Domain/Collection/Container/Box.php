<?php
class Domain_Collection_Container_Box implements Domain_Collection_Container_Interface {
    
    private $references;
    
    public function __construct() {
        
        $this->references = array();
        
    }
    
    public function add($keyObject, $valueObject) {
        
        $this->references[spl_object_hash($keyObject)] = $valueObject;
        
    }
    
    public function remove($keyObject) {
        
        unset($this->references[spl_object_hash($keyObject)]);
        
    }
    
    public function get($keyObject) {
        
        if (!$this->has($keyObject)) {
            throw new Domain_Collection_Container_Exception('Попытка извлечь из контейнера объект по несуществующему ключу.');
        }
        
        return $this->references[spl_object_hash($keyObject)];
        
    }
    
    public function has($keyObject) {
        
        return array_key_exists(spl_object_hash($keyObject), $this->references);
        
    }
}
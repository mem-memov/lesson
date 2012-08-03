<?php
abstract class Data_State_AbstractState implements Data_State_TrackableInterface {
    
    protected $id;
    
    public function hasId() {
        
        return !is_null($this->id);
        
    }
    
    public function setId($id) {
        
        if ($this->hasId()) {
            throw new Data_State_Exception('Идентификатор можно установить только один раз.');
        }
        
        $this->id = $id;
        
    }
    
    public function getId() {
        
        if (!$this->hasId()) {
            throw new Data_State_Exception('Пока идентификатор не установлен его невозможно прочитать.');
        }
        
        return $this->id;
        
    }
    
}

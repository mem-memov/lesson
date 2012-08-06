<?php
/**
 * Абстрактное состояние
 * Реализует операции с идентификатором
 */
abstract class Data_State_Item_Abstract 
implements 
    Data_State_Item_TrackableInterface 
{
    
    protected $id;
    
    /**
     * Проверяет, установлен ли идентификатор состояния
     * @return boolean
     */
    public function hasId() {
        
        return !is_null($this->id);
        
    }
    
    /**
     * Устанавливает значение идентификатора
     * @param integer $id
     * @throws Data_State_Item_Exception
     */
    public function setId($id) {
        
        if ($this->hasId()) {
            throw new Data_State_Item_Exception('Идентификатор можно установить только один раз.');
        }
        
        $this->id = $id;
        
    }
    
    /**
     * Возвращает значение идентификатора
     * @return integer
     * @throws Data_State_Item_Exception
     */
    public function getId() {
        
        if (!$this->hasId()) {
            throw new Data_State_Item_Exception('Пока идентификатор не установлен его невозможно прочитать.');
        }
        
        return $this->id;
        
    }
    
}

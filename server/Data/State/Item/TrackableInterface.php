<?php
/**
 * Интерфейс идентифицируемых состояний
 */
interface Data_State_Item_TrackableInterface {
    
    /**
     * Проверяет, установлен ли идентификатор состояния
     */
    public function hasId();
    
    /**
     * Устанавливает значение идентификатора
     * @param integer $id
     */
    public function setId($id);
    
    /**
     * Возвращает значение идентификатора
     */
    public function getId();
    
}

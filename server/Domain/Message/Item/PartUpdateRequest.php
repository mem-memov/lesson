<?php
/**
 * Запрос на изменение части урока
 */
class Domain_Message_Item_PartUpdateRequest {
    
    /**
     * Цена
     * @var integer
     */
    private $price;
    
    /**
     * Номер по порядку
     * @var integer
     */
    private $order;
    
    /**
     * Создаёт экземпляр класса
     * @param integer $price цена
     * @param integer $order номер по порядку
     */
    public function __construct($price, $order) {
        
        $this->price = $price;
        $this->order = $order;
        
    }
    
    /**
     * Сообщает новую цену
     * @return integer
     */
    public function getPrice() {
        
        return $this->price;
        
    }
    
    /**
     * Сообщает новый порядковый номер
     * @return integer
     */
    public function getOrder() {
        
        return $this->order;
        
    }
    
}
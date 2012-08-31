<?php
/**
 * Запрос на изменение части урока
 */
class Domain_Message_Part_Request_PartUpdateRequest {
    
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
    
    public function mustSetPrice() {
        
        return !is_null($this->price);
        
    }
    
    /**
     * Сообщает новую цену
     * @return integer
     */
    public function getPrice() {
        
        if (!$this->mustSetPrice()) {
            throw new Domain_Message_Item_Exception('Цену менять не нужно.');
        }
        
        return $this->price;
        
    }
    
    public function mustSetOrder() {
        
        return !is_null($this->order);
        
    }
    
    /**
     * Сообщает новый порядковый номер
     * @return integer
     */
    public function getOrder() {
        
        if (!$this->mustSetOrder()) {
            throw new Domain_Message_Item_Exception('Порядковый номер менять не нужно.');
        }
        
        return $this->order;
        
    }
    
}
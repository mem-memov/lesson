<?php
/**
 * Инспектор частей урока
 */
class Domain_Message_Item_PartInspector {
    
    /**
     * ID частей урокаs
     * @var integer[]
     */
    private $partIds;
    
    /**
     * Стоимость всего урока
     * @var integer
     */
    private $totalPrice;
    
    /**
     * Создаёт экземпляр класса
     */
    public function __construct() {
        
        $this->partIds = array();
        $this->totalPrice = 0;
        
    }
    
    /**
     * Добавляет ID части урока
     * @return integer $partId ID части урока
     */
    public function addPartId($partId) {
        
        $this->partIds[] = $partId;
        
    }
    
    /**
     * Сообщает идентификаторы частей урока
     * @return integer[]
     */
    public function getPartIds() {
        
        return $this->partIds;
        
    }
    
    /**
     * Увеличивает цену урока
     * @param integer $amount
     */
    public function increasePrice($amount) {
        
        $this->totalPrice += $amount;
        
    }
    
    /**
     * Сообщает общую стоимость урока
     * @return integer
     */
    public function getTotalPrice() {
        
        return $this->totalPrice;
        
    }
    
}
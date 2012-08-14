<?php
/**
 * Анонс части урока
 */
class Domain_Message_Item_PartAnnouncement 
{
    
    /**
     * ID части урока
     * @var integer
     */
    private $partId;
    
    /**
     * Номер по порядку
     * @var integer
     */
    private $order;
    
    /**
     * Цена данной части урока
     * @var integer
     */
    private $price;

    
    /**
     * Создаёт экземпляр класса
     * @param integer $partId ID части урока
     * @param integer $order номер по порядку
     * @param integer $price цена данной части урока
     */
    public function __construct(
        $partId,
        $order,
        $price
    ) {
        
        $this->partId = $partId;
        $this->order = $order;
        $this->price = $price;
        
    }
    
    /**
     * Преобразует в массив
     * @return array
     */
    public function toArray() {

        return array(
            'part_id' => $this->partId,
            'order' => $this->order,
            'price' => $this->price
        );
        
    }

}
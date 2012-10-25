<?php
/**
 * Часть урока
 */
class Data_State_Item_Part extends Data_State_Item_Abstract {
    
    /**
     * ID урока
     * @var integer
     */
    private $lessonId;
    public function setLessonId($lessonId) {
        $this->lessonId = $lessonId;
    }
    public function getLessonId() {
        return $this->lessonId;
    }
    
    /**
     * Номер по порядку
     * @var integer
     */
    private $order;
    public function setOrder($order) {
        $this->order = $order;
    }
    public function getOrder() {
        return $this->order;
    }
    
    /**
     * Цена
     * @var integer
     */
    private $price;
    public function setPrice($price) {
        $this->price = $price;
    }
    public function getPrice() {
        return $this->price;
    }
    
    /**
     * ID пособий
     * @var array 
     */
    private $widgetIds = array();
    public function setWidgetIds(array $widgetIds) {
        $this->widgetIds = $widgetIds;
    }
    public function getWidgetIds() {
        return $this->widgetIds;
    }
    
    /**
     * ID видов пособий
     * @var array 
     */
    private $widgetTypeIds = array();
    public function setWidgetTypeIds(array $widgetTypeIds) {
        $this->widgetTypeIds = $widgetTypeIds;
    }
    public function getWidgetTypeIds() {
        return $this->widgetTypeIds;
    }
    
}
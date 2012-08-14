<?php
/**
 * Запрос на прикрепление пособия к части урока
 */
class Domain_Message_Item_PartJoinCall {
    
    /**
     * ID учебных пособий
     * @var integer[]
     */
    private $widgetIds;
    
    /**
     * Создаёт экземпляр класса
     * @param integer[] $widgetIds ID учебных пособий
     */
    public function __construct(
        array &$widgetIds
    ) {
        
        $this->widgetIds =& $widgetIds;
        
    }
    
    /**
     * Передаёт ID учебного пособия
     * @return integer $widgetId ID учебного пособия
     */
    public function addWidgetId($widgetId) {

        $this->widgetIds[] = $widgetId;

    }
    
}
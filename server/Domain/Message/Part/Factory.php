<?php
class Domain_Message_Part_Factory {
    
    /**
     * Создаёт презентацию части урока
     * @param integer $partId ID части урока
     * @param integer $order номер по порядку
     * @param integer $price цена данной части урока
     * @param array $widgetPresentations показы учебных пособий
     * @param array $widgetTypes нзвания типов учебных пособий
     */
    public function makePartPresentation(
        $partId,
        $order,
        $price,
        array $widgetPresentations,
        array $widgetTypes
    ) {
        
        return new Domain_Message_Part_Response_PartPresentation(
            $partId,
            $order,
            $price,
            $widgetPresentations,
            $widgetTypes
        );
        
    }
    
    /**
     * Создаёт анонс части урока
     * @param integer $partId ID части урока
     * @param integer $order номер по порядку
     * @param integer $price цена данной части урока
     */
    public function makePartAnnouncement(
        $partId,
        $order,
        $price
    ) {
        
        return new Domain_Message_Part_Response_PartAnnouncement(
            $partId,
            $order,
            $price
        );
        
    }
    
    /**
     * Создаёт запрос на прикрепление текстового пособия к части урока
     * @param integer[] $widgetIds ID учебных пособий
     * @return Domain_Message_Item_PartJoinCall
     */
    public function makeTextJoinCall(
        array &$widgetIds
    ) {
        
        return new Domain_Message_Item_PartJoinCall($widgetIds);
        
    }
    
}
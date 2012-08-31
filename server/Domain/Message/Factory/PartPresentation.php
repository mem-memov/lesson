<?php
class Domain_Message_Factory_PartPresentation {
    
    /**
     * Создаёт сообщение
     * @param integer $partId ID части урока
     * @param integer $order номер по порядку
     * @param integer $price цена данной части урока
     * @param array $widgetPresentations показы учебных пособий
     * @param array $widgetTypes нзвания типов учебных пособий
     */
    public function makeMessage(
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
    
}
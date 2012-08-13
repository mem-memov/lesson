<?php
class Domain_Message_Factory_PartPresentation {
    
    /**
     * Создаёт сообщение
     * @param integer $partId ID части урока
     * @param array $widgetPresentations показы учебных пособий
     * @return Domain_Message_Item_PartPresentation
     */
    public function makeMessage(
        $partId,
        array $widgetPresentations
    ) {
        
        return new Domain_Message_Item_PartPresentation(
            $partId,
            $widgetPresentations
        );
        
    }
    
}
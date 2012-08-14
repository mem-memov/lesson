<?php
class Domain_Message_Factory_PartJoinCall {
    
    /**
     * Создаёт сообщение
     * @param integer[] $widgetIds ID учебных пособий
     * @return Domain_Message_Item_PartJoinCall
     */
    public function makeMessage(
        array &$widgetIds
    ) {
        
        return new Domain_Message_Item_PartJoinCall($widgetIds);
        
    }
    
}
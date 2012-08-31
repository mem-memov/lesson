<?php
class Domain_Message_Factory_PartAnnouncement {
    
    /**
     * Создаёт сообщение
     * @param integer $partId ID части урока
     * @param integer $order номер по порядку
     * @param integer $price цена данной части урока
     */
    public function makeMessage(
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
    
}
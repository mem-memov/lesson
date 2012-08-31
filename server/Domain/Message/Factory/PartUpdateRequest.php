<?php
class Domain_Message_Factory_PartUpdateRequest {
    
    /**
     * Создаёт сообщение
     * @param integer $price цена
     * @param integer $order номер по порядку
     * @return Domain_Message_Part_Request_PartUpdateRequest
     */
    public function makeMessage($price, $order) {
        
        return new Domain_Message_Part_Request_PartUpdateRequest($price, $order);
        
    }
    
}
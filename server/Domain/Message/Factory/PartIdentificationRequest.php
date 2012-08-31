<?php
class Domain_Message_Factory_PartIdentificationRequest {
    
    /**
     * Создаёт сообщение
     * @param Data_State_Item_Visit $visitState состояние посещения
     * @return Domain_Message_Part_Request_PartIdentificationRequest
     */
    public function makeMessage(
        Data_State_Item_Visit $visitState
    ) {
        
        return new Domain_Message_Part_Request_PartIdentificationRequest($visitState);
        
    }
    
}
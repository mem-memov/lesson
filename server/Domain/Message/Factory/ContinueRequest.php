<?php
class Domain_Message_Factory_ContinueRequest {
    
    /**
     * Создаёт сообщение
     * @param integer[] partIds ID ученика
     * @return Domain_Message_Item_ContinueRequest
     */
    public function makeMessage(array $partIds) {
        
        return new Domain_Message_Item_ContinueRequest($partIds);
        
    }
    
}
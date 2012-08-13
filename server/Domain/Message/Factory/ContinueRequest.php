<?php
class Domain_Message_Factory_ContinueRequest {
    
    /**
     * Создаёт сообщение
     * @param Domain_Collection_Part $partCollection коллекция частей урока
     * @return Domain_Message_Item_ContinueRequest
     */
    public function makeMessage(
        Domain_Collection_Part $partCollection
    ) {
        
        return new Domain_Message_Item_ContinueRequest($partCollection);
        
    }
    
}
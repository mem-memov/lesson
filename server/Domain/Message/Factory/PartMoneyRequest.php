<?php
class Domain_Message_Factory_PartMoneyRequest {
    
    /**
     * Создаёт сообщение
     * @param Domain_Account $account счёт
     * @return Domain_Message_Item_PartMoneyRequest
     */
    public function makeMessage(
        Domain_Account $account
    ) {
        
        return new Domain_Message_Item_PartMoneyRequest($account);
        
    }
    
}
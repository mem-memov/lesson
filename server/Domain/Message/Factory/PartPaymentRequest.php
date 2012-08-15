<?php
class Domain_Message_Factory_PartPaymentRequest {
    
    /**
     * Создаёт сообщение
     * @param Domain_Account $account счёт
     * @return Domain_Message_Item_PartPaymentRequest
     */
    public function makeMessage(
        Domain_Account $account
    ) {
        
        return new Domain_Message_Item_PartPaymentRequest($account);
        
    }
    
}
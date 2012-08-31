<?php
class Domain_Message_Factory_PartPaymentRequest {
    
    /**
     * Создаёт сообщение
     * @param Domain_Account $account счёт
     * @param Domain_Collection_Account $accountCollection коллекция счетов
     * @return Domain_Message_Part_Request_PartPaymentRequest
     */
    public function makeMessage(
        Domain_Account $account,
        Domain_Collection_Account $accountCollection
    ) {
        
        return new Domain_Message_Part_Request_PartPaymentRequest($account, $accountCollection);
        
    }
    
}
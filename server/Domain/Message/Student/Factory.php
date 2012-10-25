<?php
class Domain_Message_Student_Factory {

    /**
     * Создаёт запрос на оплату части урока
     * @param Domain_Account $account счёт
     * @param Domain_Collection_Account $accountCollection коллекция счетов
     * @return Domain_Message_Part_Request_PartPaymentRequest
     */
    public function makePartPaymentRequest(
        Domain_Account $account,
        Domain_Collection_Account $accountCollection
    ) {
        
        return new Domain_Message_Part_Request_PartPaymentRequest($account, $accountCollection);
        
    }
    
}
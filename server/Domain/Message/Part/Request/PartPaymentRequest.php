<?php
/**
 * Запрос на оплату части урока
 */
class Domain_Message_Part_Request_PartPaymentRequest {
    
    /**
     * Счёт
     * @var Domain_Account
     */
    private $account;
    
    /**
     * Коллекция счетов
     * @var Domain_Collection_Account
     */
    private $accountCollection;
    
    /**
     * Создаёт экземпляр класса
     * @param Domain_Account $account счёт
     * @param Domain_Collection_Account $accountCollection коллекция счетов
     */
    public function __construct(
        Domain_Account $account,
        Domain_Collection_Account $accountCollection
    ) {
        
        $this->account = $account;
        $this->accountCollection = $accountCollection;
        
    }
    
    /**
     * Берёт цену части урока
     * @return integer $price цена
     */
    public function takePrice($price) {
        
        $this->account->decrease($price);
        $this->accountCollection->update($this->account);
        
    }
    
}
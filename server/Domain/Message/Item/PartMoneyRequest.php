<?php
/**
 * Запрос на получение денег за показ части урока
 */
class Domain_Message_Item_PartMoneyRequest {
    
    /**
     * Счёт
     * @var Domain_Account
     */
    private $account;
    
    /**
     * Создаёт экземпляр класса
     * @param Domain_Account $account счёт
     */
    public function __construct(
        Domain_Account $account
    ) {
        
        $this->account = $account;
        
    }
    
    /**
     * Берёт цену части урока
     * @return integer $price цена
     */
    public function giveMoney($price) {
        
        $this->account->increase($price);
        
    }
    
}
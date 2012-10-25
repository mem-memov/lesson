<?php
/**
 * Состояние счёта
 */
class Data_State_Item_Account extends Data_State_Item_Abstract {
    
    /**
     * Сумма на счёте
     * @var integer 
     */
    private $amount;
    public function setAmount($amount) {
        $this->amount = $amount;
    }
    public function getAmount() {
        return $this->amount;
    }

}

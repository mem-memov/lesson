<?php
class Data_State_Account_Item extends Data_State_Item_Abstract {
    
    private $amount;
    public function setAmount($amount) {
        
        $this->amount = $amount;
        
    }
    public function getAmount() {
        
        return $this->amount;
        
    }
    
    
}

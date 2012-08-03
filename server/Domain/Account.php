<?php
class Domain_Account extends Domain_AbstractItem {
    
    public function __construct(Data_State_Account_Item $state) {
        
        $this->state = $state;
        
    }
    
    public function deposit($amount) {
        $this->state->setAmount( $this->state->getAmount() + $amount );
    }
    
    public function withdraw($amount) {
        $this->state->setAmount( $this->state->getAmount() - $amount );
    }
    
    public function canWithdraw($amount) {
        return ( $this->state->getAmount() - $amount ) >= 0;
    }
    
}

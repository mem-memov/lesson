<?php
class Domain_Account {
    
    private $sate;
    
    public function __construct(
        Data_State_Item_Account $state
    ) {
        
        $this->state = $state;
        
    }
    
    public function increase($amount) {
        $this->state->setAmount( $this->state->getAmount() + $amount );
    }
    
    public function decrease($amount) {
        $this->state->setAmount( $this->state->getAmount() - $amount );
    }
    
    public function canDecrease($amount) {
        return ( $this->state->getAmount() - $amount ) >= 0;
    }
    
}

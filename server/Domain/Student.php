<?php
class Domain_Student {
    
    private $state;
    private $account;
    
    public function __construct(
        Data_State_Item_User $state,
        Domain_Account $account
    ) {
        
        $this->state = $state;
        $this->account = $account;
        
    }
    
    
    public function learn($lesson) {
        
        
        
    }
    
    public function deposit($amount) {
        
        $this->account->increase($amount);
        
    }
    
    private function canWithdraw($amount) {
        
        return $this->account->canDecrease($amount);
        
    }
    
    private function withdraw($amount) {
        
        $this->account->decrease($amount);
        
    }
    
}

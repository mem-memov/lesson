<?php
class Domain_Teacher {

    private $state;
    private $account;
    
    public function __construct(
        Data_State_Lesson_Item $state,
        Domain_Account $account
    ) {
        
        $this->state = $state;
        $this->account = $account;
        
    }
    
    
    public function teach($lesson) {
        
        
        
    }
    
    public function prepare(array $lessonArray) {
        
        
        
    }

    public function canWithdraw($amount) {
        
        return $this->account->canDecrease($amount);
        
    }
    
    public function withdraw($amount) {
        
        $this->account->decrease($amount);
        
    }
    
    private function deposit($amount) {
        
        $this->account->increase($amount);
        
    } 
 
}

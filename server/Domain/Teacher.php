<?php
class Domain_Teacher {

    private $state;
    private $account;
    private $lessonCollection;
    
    public function __construct(
        Data_State_Item_User $state,
        Domain_Account $account,
        Domain_Collection_Lesson $lessonCollection
    ) {
        
        $this->state = $state;
        $this->account = $account;
        $this->lessonCollection = $lessonCollection;
        
    }
    
    
    public function teach($lesson) {
        
        
        
    }
    
    public function prepare(array $lessonArray) {
        
        $lesson = $this->lessonCollection->create($lessonArray['title'], $lessonArray['description']);
        $this->lessonCollection->update($lesson);
        
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

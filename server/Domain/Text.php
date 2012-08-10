<?php
class Domain_Text {
    
    private $state;
    
    public function __construct(
        Data_State_Item_Text $state
    ) {
        
        $this->state = $state;
        
    }
    
    public function getId() {
        
        return $this->state->getId();
        
    }
    
}
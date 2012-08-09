<?php
class Domain_Part {
    
    private $state;
    
    public function __construct(
        Data_State_Item_Part $state
    ) {
        
        $this->state = $state;
        
    }
    
}
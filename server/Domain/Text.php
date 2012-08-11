<?php
class Domain_Text 
implements
    Domain_CanBeShown
{
    
    private $state;
    
    public function __construct(
        Data_State_Item_Text $state
    ) {
        
        $this->state = $state;
        
    }
    
    public function getId() {
        
        return $this->state->getId();
        
    }
    
    public function show() {
        
        return array(
            'id' => $this->state->getId(),
            'text' => $this->state->getText()
        );
        
    }
    
}
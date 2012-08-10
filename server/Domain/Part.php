<?php
class Domain_Part {
    
    private $state;
    
    public function __construct(
        Data_State_Item_Part $state
    ) {
        
        $this->state = $state;
        
    }
    
    public function getId() {
        
        return $this->state->getId();
        
    }
    
    public function setOrder($order) {
        
        $this->state->setOrder($order);
        
    }
    
    public function setPrice($price) {
        
        $this->state->setPrice($price);
        
    }
    
}
<?php
class Domain_Visit {
    
    private $state;
    
    public function __construct(
        Data_State_Item_Visit $state
    ) {
        
        $this->state = $state;
        
    }
    
    public function getId() {
        
        return $this->state->getId();
        
    }
    
    public function getPartId() {
        
        return $this->state->getPartId();
        
    }
    
    public function setPartId($partId) {
        
        $this->state->setPartId($partId);
        
    }
    
}
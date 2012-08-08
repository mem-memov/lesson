<?php
class Domain_Lesson {
    
    public function __construct(Data_State_Item_Lesson $state) {
        
        $this->state = $state;
        
    }
    
    public function toArray() {
        return array(
            'id' => $this->state->hasId() ? $this->state->getId() : null,
            'title' => $this->state->getTitle(),
            'description' => $this->state->getDescription()
        );
    }
    
}

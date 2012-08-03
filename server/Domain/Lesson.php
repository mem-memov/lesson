<?php
class Domain_Lesson extends Domain_AbstractItem {
    
    public function __construct(Data_State_Lesson_Item $state) {
        
        $this->state = $state;
        
    }
    
}

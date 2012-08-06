<?php
class Domain_Collection_Constructor_Lesson implements Domain_Collection_Constructor_Interface {
    
    public function make($state) {
        
        $state instanceof Data_State_Item_Lesson;

        return new Domain_Lesson($state);
        
    }
    
}
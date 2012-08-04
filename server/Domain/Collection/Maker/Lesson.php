<?php
class Domain_Collection_Maker_Lesson implements Domain_Collection_Maker_Interface {
    
    public function make($state) {
        
        $state instanceof Data_State_Item_Lesson;

        return new Domain_Lesson($state);
        
    }
    
}
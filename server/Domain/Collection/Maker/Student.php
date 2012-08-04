<?php
class Domain_Collection_Maker_Student implements Domain_Collection_Maker_Interface {
    
    public function make($state) {
        
        $state instanceof Data_State_Item_Student;
        
        return new Domain_Student($state);
        
    }
    
}
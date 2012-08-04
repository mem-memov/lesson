<?php
class Domain_Collection_Maker_Teacher implements Domain_Collection_Maker_Interface {
    
    public function make($state) {
        
        $state instanceof Data_State_Item_Teacher;
        
        return new Domain_Teacher($state);
        
    }
    
}
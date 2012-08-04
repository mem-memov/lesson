<?php
class Domain_Collection_Maker_Account implements Domain_Collection_Maker_Interface {
    
    public function make($state) {
        
        $state instanceof Data_State_Item_Account;
        
        return new Domain_Account($state);
        
    }
    
}
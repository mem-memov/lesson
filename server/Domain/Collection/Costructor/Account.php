<?php
class Domain_Collection_Constructor_Account implements Domain_Collection_Constructor_Interface {
    
    public function make($state) {
        
        $state instanceof Data_State_Item_Account;
        
        return new Domain_Account($state);
        
    }
    
}
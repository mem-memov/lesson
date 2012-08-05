<?php
class Domain_Collection_Maker_Teacher implements Domain_Collection_Maker_Interface {
    
    public function make(
        Data_State_Teacher_Item $state, 
        Domain_Account $account
    ) {

        return new Domain_Teacher($state, $account);
        
    }
    
}
<?php
class Data_State_Factory_Account implements Data_State_Factory_Interface {
    
    public function makeState() {
        
        return new Data_State_Item_Account();
        
    }
    
}

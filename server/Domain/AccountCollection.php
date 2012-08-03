<?php
class Domain_AccountCollection extends Domain_AbstractCollection {
    
    protected function make(Data_State_Account_Item $state) {
        
        return new Domain_Account($state);
        
    }
    
}

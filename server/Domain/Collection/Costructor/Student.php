<?php
class Domain_Collection_Constructor_Student 
implements 
    Domain_Collection_Constructor_Interface 
{
    
    public function make(
        Data_State_Student_Item $state, 
        Domain_Account $account
    ) {
        
        $state instanceof Data_State_Item_Student;
        
        return new Domain_Student($state, $account);
        
    }
    
}
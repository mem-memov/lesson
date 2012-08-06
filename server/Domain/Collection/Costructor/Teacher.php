<?php
class Domain_Collection_Constructor_Teacher 
implements 
    Domain_Collection_Constructor_TeacherInterface 
{
    
    public function construct(
        Data_State_Teacher_Item $state, 
        Domain_Account $account
    ) {

        return new Domain_Teacher($state, $account);
        
    }
    
}
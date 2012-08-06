<?php
interface Domain_Collection_Constructor_StudentInterface {
    
    public function construct(
        Data_State_Student_Item $state, 
        Domain_Account $account
    );
    
}
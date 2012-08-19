<?php
class Domain_User {

    /**
     * Сосояние
     * @var Data_State_Item_User 
     */
    private $state;

    
    public function __construct(
        Data_State_Item_User $state
    ) {
        
        $this->state = $state;
        
    }



}

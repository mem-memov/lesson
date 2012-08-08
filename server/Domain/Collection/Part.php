<?php
class Domain_Collection_Part {

    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_Crud_Part 
     */
    private $dataAccess;
    
    /**
     * Состояния
     * @var array 
     */
    private $states;

    
    public function __construct(
        Data_Access_Part $dataAccess
    ) {
        
        $this->dataAccess = $dataAccess;
        
        $this->states = array();
        
    }
    
}
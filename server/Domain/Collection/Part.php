<?php
class Domain_Collection_Part {

    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_PartText 
     */
    private $partTextAccess;
    
    /**
     * Состояния
     * @var array 
     */
    private $states;

    
    public function __construct(
        Data_Access_PartText $partTextAccess
    ) {
        
        $this->partTextAccess = $partTextAccess;
        
        $this->states = array();
        
    }
    
    public function create() {
        
    }
    
}
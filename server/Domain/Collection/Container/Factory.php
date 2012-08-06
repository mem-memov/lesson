<?php
class Domain_Collection_Container_Factory implements Domain_Collection_Container_FactoryInterface {
    
    public function makeContainer() {
        
        return new Domain_Collection_Container_Box();
        
    }
    
}
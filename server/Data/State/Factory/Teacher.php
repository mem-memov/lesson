<?php
/**
 * Фабрика состояний учителейs
 */
class Data_State_Factory_Teacher implements Data_State_Factory_Interface {
    
    public function makeState() {
        
        return new Data_State_Item_Teacher();
        
    }
    
}
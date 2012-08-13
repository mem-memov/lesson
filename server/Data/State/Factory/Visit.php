<?php
/**
 * Фабрика состояний посещений
 */
class Data_State_Factory_Visit implements Data_State_Factory_Interface {
    
    public function makeState() {
        
        return new Data_State_Item_Visit();
        
    }
    
}
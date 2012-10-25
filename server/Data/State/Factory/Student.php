<?php
/**
 * Фабрика состояний учеников
 */
class Data_State_Factory_Student implements Data_State_Factory_Interface {
    
    public function makeState() {
        
        return new Data_State_Item_Student();
        
    }
    
}
<?php
/**
 * Фабрика почтовых адресов
 */
class Data_State_Factory_Email implements Data_State_Factory_Interface {
    
    public function makeState() {
        
        return new Data_State_Item_Email();
        
    }
    
}

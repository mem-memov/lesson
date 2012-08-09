<?php
/**
 * Фабрика текстов
 */
class Data_State_Factory_Text implements Data_State_Factory_Interface {
    
    public function makeState() {
        
        return new Data_State_Item_Text();
        
    }
    
}
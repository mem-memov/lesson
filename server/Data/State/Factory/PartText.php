<?php
/**
 * Фабрика текстовых частей урока
 */
class Data_State_Factory_PartText implements Data_State_Factory_Interface {
    
    public function makeState() {
        
        return new Data_State_Item_PartText();
        
    }
    
}
<?php
/**
 * Фабрика текстовых частей урока
 */
class Data_Factory_Part_Text implements Data_State_Factory_Interface {
    
    public function makeState() {
        
        return new Data_State_Item_PartText();
        
    }
    
}
<?php
/**
 * Фабрика состояний пользователей
 */
class Data_State_Factory_User implements Data_State_Factory_Interface {
    
    public function makeState() {
        
        return new Data_State_Item_User();
        
    }
    
}

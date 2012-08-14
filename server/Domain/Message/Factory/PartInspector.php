<?php
class Domain_Message_Factory_PartInspector {

    /**
     * Создаёт сообщение
     * @return Domain_Message_Item_PartInspector
     */
    public function makeMessage() {
        
        return new Domain_Message_Item_PartInspector();
        
    }
    
}
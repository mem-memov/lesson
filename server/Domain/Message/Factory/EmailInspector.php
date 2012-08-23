<?php
class Domain_Message_Factory_EmailInspector {

    /**
     * Создаёт сообщение
     * @return Domain_Message_Item_EmailInspector
     */
    public function makeMessage() {
        
        return new Domain_Message_Item_EmailInspector();
        
    }
    
}
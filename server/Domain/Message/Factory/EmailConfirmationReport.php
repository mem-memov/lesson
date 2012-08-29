<?php
class Domain_Message_Factory_EmailConfirmationReport {
    
    /**
     * Создаёт сообщение
     * @param Domain_Exception[] $problems проблемы, возникшие при подтверждении адреса электронной почты
     * @return Domain_Message_Item_EmailConfirmationReport
     */
    public function makeMessage(
        array $problems = array()
    ) {
        
        return new Domain_Message_Item_EmailConfirmationReport(
            $problems
        );
        
    }
    
}
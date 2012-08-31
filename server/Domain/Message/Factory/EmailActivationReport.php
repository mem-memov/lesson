<?php
class Domain_Message_Factory_EmailActivationReport {
    
    /**
     * Создаёт сообщение
     * @param Domain_Exception[] $problems проблемы, возникшие при активации адреса электронной почты
     * @return Domain_Message_Guard_Response_EmailActivationReport
     */
    public function makeMessage(
        array $problems = array()
    ) {
        
        return new Domain_Message_Guard_Response_EmailActivationReport(
            $problems
        );
        
    }
    
}
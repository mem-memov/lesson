<?php
class Domain_Message_User_Factory {

    /**
     * Создаёт инспектора почтовых адресов
     * @return Domain_Message_Email_Request_EmailInspector
     */
    public function makeEmailInspector() {
        
        return new Domain_Message_Email_Request_EmailInspector();
        
    }
    
    /**
     * Создаёт запрос об отправке почты
     * @param string $letterTemplateName название шаблона письма
     * @param array $data данные для подстановки в шаблон
     * @return Domain_Message_User_Request_MailReceptionRequest
     */
    public function makeMailRequest($letterTemplateName, array $data = array()) {
        
        return new Domain_Message_Email_Request_MailRequest($letterTemplateName, $data);
        
    }

    /**
     * Создаёт отчёт о подтверждении владения адресом электронной почты
     * @param Domain_Exception[] $problems проблемы, возникшие при подтверждении адреса электронной почты
     * @return Domain_Message_User_Response_EmailConfirmationReport
     */
    public function makeEmailConfirmationReport(
        array $problems = array()
    ) {
        
        return new Domain_Message_User_Response_EmailConfirmationReport(
            $problems
        );
        
    }
    
}
<?php
class Domain_Message_Guard_Factory {

    /**
     * Создаёт запрос на получение почты
     * @param string $letterTemplateName название шаблона письма
     * @param array $data данные для подстановки в шаблон
     * @return Domain_Message_User_Request_MailReceptionRequest
     */
    public function makeMailReceptionRequest($letterTemplateName, array $data = array()) {
        
        return new Domain_Message_User_Request_MailReceptionRequest($letterTemplateName, $data);
        
    }
    
    /**
     * Создаёт отчёт о начале регистрации пользователя
     * @param boolean $emailIsOccupied почтовый адрес занят
     * @return Domain_Message_Guard_Response_EnrollmentReport
     */
    public function makeEnrollmentReport(
        $emailIsOccupied
    ) {
        
        return new Domain_Message_Guard_Response_EnrollmentReport(
            $emailIsOccupied
        );
        
    }
    
    /**
     * Создаёт запрос подтвердить адрес электронной почты
     * @param string $email aдрес электронной почты
     * @return Domain_Message_User_Request_EmailConfirmationRequest
     */
    public function makeEmailConfirmationRequest($email) {
        
        return new Domain_Message_User_Request_EmailConfirmationRequest($email);
        
    }
    
    /**
     * Создаёт отчёт об активации адреса электронной почты
     * @param Domain_Exception[] $problems проблемы, возникшие при активации адреса электронной почты
     * @return Domain_Message_Guard_Response_EmailActivationReport
     */
    public function makeEmailActivationReport(
        array $problems = array()
    ) {
        
        return new Domain_Message_Guard_Response_EmailActivationReport(
            $problems
        );
        
    }
    
}
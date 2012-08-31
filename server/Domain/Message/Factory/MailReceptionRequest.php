<?php
class Domain_Message_Factory_MailReceptionRequest {
    
    /**
     * Создаёт сообщение
     * @param string $letterTemplateName название шаблона письма
     * @param array $data данные для подстановки в шаблон
     * @return Domain_Message_User_Request_MailReceptionRequest
     */
    public function makeMessage($letterTemplateName, array $data = array()) {
        
        return new Domain_Message_User_Request_MailReceptionRequest($letterTemplateName, $data);
        
    }
    
}
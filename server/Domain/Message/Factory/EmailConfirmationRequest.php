<?php
class Domain_Message_Factory_EmailConfirmationRequest {
    
    /**
     * Создаёт сообщение
     * @param string $email aдрес электронной почты
     * @return Domain_Message_Item_EmailConfirmationRequest
     */
    public function makeMessage($email) {
        
        return new Domain_Message_Item_EmailConfirmationRequest($email);
        
    }
    
}
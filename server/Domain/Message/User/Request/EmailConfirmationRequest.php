<?php
/**
 * Запрос подтвердить адрес электронной почты
 */
class Domain_Message_User_Request_EmailConfirmationRequest {
    
    /**
     * Адрес электронной почты
     * @var string
     */
    private $email;
    
    /**
     * Создаёт экземпляр класса
     * @param string $email aдрес электронной почты
     */
    public function __construct($email) {
        
        $this->email = $email;
        
    }
    
    /**
     * Сообщает aдрес электронной почты
     * @return string
     */
    public function getEmail() {
        
        return $this->email;
        
    }
    
}
<?php
/**
 * Запрос на получение электронной почты
 */
class Domain_Message_User_Request_MailReceptionRequest {
    
    /**
     * Название шаблона письма
     * @var string
     */
    private $letterTemplateName;
    
    /**
     * Данные для подстановки в шаблон
     * @var array
     */
    private $data;
    
    /**
     * Создаёт экземпляр класса
     * @param string $letterTemplateName название шаблона письма
     * @param array $data данные для подстановки в шаблон
     */
    public function __construct($letterTemplateName, array $data = array()) {
        
        $this->letterTemplateName = $letterTemplateName;
        $this->data = $data;
        
    }
    
    /**
     * Сообщает название шаблона письма
     * @return string
     */
    public function getLetterTemplateName() {
        
        return $this->letterTemplateName;
        
    }
    
    /**
     * Сообщает данные для подстановки в шаблон
     * @return array
     */
    public function getData() {
        
        return $this->data;
        
    }
    
}
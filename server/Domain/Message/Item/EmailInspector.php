<?php
/**
 * Инспектор почтовых адресов
 */
class Domain_Message_Item_EmailInspector {
    
    /**
     * почтовые адреса
     * @var string[]
     */
    private $emails;
    
    /**
     * Создаёт экземпляр класса
     */
    public function __construct() {
        
        $this->emails = array();
        
    }
    
    /**
     * Добавляет почтовый адрес
     * @param string $email почтовый адрес
     */
    public function addEmail($email) {
        
        $this->emails[] = $email;
        
    }
    
    /**
     * Сообщает почтовые адреса
     * @return string[]
     */
    public function getEmails() {
        
        return $this->emails;
        
    }

}
<?php
/**
 * Отчёт о начале регистрации пользователя
 */
class Domain_Message_Guard_Response_EnrollmentReport {
    
    /**
     * Почтовый адрес занят
     * @var boolean
     */
    private $emailIsOccupied;
    
    /**
     * Создаёт экземпляр класса
     * @param boolean $emailIsOccupied почтовый адрес занят
     */
    public function __construct(
        $emailIsOccupied
    ) {
        
        $this->emailIsOccupied = $emailIsOccupied;
        
    }
    
    /**
     * Сообщает, не занят ли указанный пользователем адрес электронной почты
     * @return boolean
     */
    public function emailIsOccupied() {
        
        return $this->emailIsOccupied;
        
    }
    
}
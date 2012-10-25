<?php
/**
 * Запрос на изучение части урока
 */
class Domain_Message_Student_Request_LearnRequest {
    
    /**
     * Часть урока
     * @var Domain_Part
     */
    private $part;
    
    /**
     * Создаёт экземпляр класса
     * @param Domain_Part $part часть урока
     */
    public function __construct(Domain_Part $part) {
        
        $this->part = $part;
        
    }
    
    /**
     * Сообщает часть урока
     * @return Domain_Part
     */
    public function getPart() {
        
        return $this->part;
        
    }
    
}
<?php
class Domain_Message_Factory_LearnRequest {
    
    /**
     * Создаёт сообщение
     * @param Domain_Part $part часть урока
     * @return Domain_Message_Student_Request_LearnRequest
     */
    public function makeMessage(Domain_Part $part) {
        
        return new Domain_Message_Student_Request_LearnRequest($part);
        
    }
    
}
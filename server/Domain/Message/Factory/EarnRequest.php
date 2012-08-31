<?php
class Domain_Message_Factory_EarnRequest {
    
    /**
     * Создаёт сообщение
     * @param Domain_Part $part часть урока
     * @return Domain_Message_Teacher_Request_EarnRequest
     */
    public function makeMessage(Domain_Part $part) {
        
        return new Domain_Message_Teacher_Request_EarnRequest($part);
        
    }
    
}
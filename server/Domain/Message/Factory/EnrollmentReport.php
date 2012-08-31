<?php
class Domain_Message_Factory_EnrollmentReport {
    
    /**
     * Создаёт сообщение
     * @param boolean $emailIsOccupied почтовый адрес занят
     * @return Domain_Message_Guard_Response_EnrollmentReport
     */
    public function makeMessage(
        $emailIsOccupied
    ) {
        
        return new Domain_Message_Guard_Response_EnrollmentReport(
            $emailIsOccupied
        );
        
    }
    
}
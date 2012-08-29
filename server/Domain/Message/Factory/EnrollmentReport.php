<?php
class Domain_Message_Factory_EnrollmentReport {
    
    /**
     * Создаёт сообщение
     * @param boolean $emailIsOccupied почтовый адрес занят
     * @return Domain_Message_Item_EnrollmentReport
     */
    public function makeMessage(
        $emailIsOccupied
    ) {
        
        return new Domain_Message_Item_EnrollmentReport(
            $emailIsOccupied
        );
        
    }
    
}
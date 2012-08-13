<?php
class Domain_Message_Factory_VisitRequest {
    
    /**
     * Создаёт сообщение
     * @param integer $studentId ID ученика
     * @param integer $teacherId ID учителя
     * @return Domain_Message_Item_VisitRequest
     */
    public function makeMessage($studentId, $teacherId) {
        
        return new Domain_Message_Item_VisitRequest($studentId, $teacherId);
        
    }
    
}
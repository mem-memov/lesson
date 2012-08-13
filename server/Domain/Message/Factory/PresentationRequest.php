<?php
class Domain_Message_Factory_PresentationRequest {
    
    /**
     * Создаёт сообщение
     * @param integer $studentId ID ученика
     * @return Domain_Message_Item_EducationRequest
     */
    public function makeMessage($studentId) {
        
        return new Domain_Message_Item_PresentationRequest($studentId);
        
    }
    
}
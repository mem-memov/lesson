<?php
class Domain_Message_Factory_EducationRequest {
    
    /**
     * Создаёт сообщение
     * @param integer $studentId ID ученика
     * @param integer $lessonId ID урока
     * @return Domain_Message_Teacher_Request_EducationRequest
     */
    public function makeMessage($studentId, $lessonId) {
        
        return new Domain_Message_Teacher_Request_EducationRequest($studentId, $lessonId);
        
    }
    
}
<?php
class Domain_Message_School_Factory {

    /**
     * Создаёт запрос на получение знаний
     * @param integer $studentId ID ученика
     * @param integer $lessonId ID урока
     * @return Domain_Message_Teacher_Request_EducationRequest
     */
    public function makeEducationRequest($studentId, $lessonId) {
        
        return new Domain_Message_Teacher_Request_EducationRequest($studentId, $lessonId);
        
    }
    
}
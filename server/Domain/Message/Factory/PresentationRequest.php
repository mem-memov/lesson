<?php
class Domain_Message_Factory_PresentationRequest {
    
    /**
     * Создаёт сообщение
     * @param integer $studentId ID ученика
     * @param Domain_Teacher $teacher учитель
     * @return Domain_Message_Lesson_Request_PresentationRequest
     */
    public function makeMessage(
        $studentId,
        Domain_Teacher $teacher
    ) {
        
        return new Domain_Message_Lesson_Request_PresentationRequest($studentId, $teacher);
        
    }
    
}
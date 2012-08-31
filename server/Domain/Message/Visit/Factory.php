<?php
class Domain_Message_Visit_Factory {

    /**
     * Создаёт запрос на идентификацию части урока
     * @param Data_State_Item_Visit $visitState состояние посещения
     * @return Domain_Message_Part_Request_PartIdentificationRequest
     */
    public function makePartIdentificationRequest(
        Data_State_Item_Visit $visitState
    ) {
        
        return new Domain_Message_Part_Request_PartIdentificationRequest($visitState);
        
    }
    
    /**
     * Создаёт показ
     * @param Domain_Message_Lesson_Response_LessonPresentation $lessonPresentation показ урока
     * @param Domain_Message_Part_Response_PartPresentation $partPresentation показ части урока
     * @param Domain_Message_Part_Response_PartAnnouncement|null $nextPartAnnouncement анонс следующей части урока
     * @param Domain_Exception[] $problems проблемы, возникшие во время посещения части урока урока
     * @return Domain_Message_Item_Presentation
     */
    public function makeLessonPresentation(
        Domain_Message_Lesson_Response_LessonPresentation $lessonPresentation,
        Domain_Message_Part_Response_PartPresentation $partPresentation = null,
        Domain_Message_Part_Response_PartAnnouncement $nextPartAnnouncement = null,
        array $problems = array()
    ) {
        
        return new Domain_Message_Item_Presentation(
            $lessonPresentation,
            $partPresentation,
            $nextPartAnnouncement,
            $problems
        );
        
    }
    
    /**
     * Создаёт запрос на изучение части урока
     * @param Domain_Part $part часть урока
     * @return Domain_Message_Student_Request_LearnRequest
     */
    public function makeLearnRequest(Domain_Part $part) {
        
        return new Domain_Message_Student_Request_LearnRequest($part);
        
    }
    
    /**
     * Создаёт запрос на зарабатывание
     * @param Domain_Part $part часть урока
     * @return Domain_Message_Teacher_Request_EarnRequest
     */
    public function makeEarnRequest(Domain_Part $part) {
        
        return new Domain_Message_Teacher_Request_EarnRequest($part);
        
    }
    
}
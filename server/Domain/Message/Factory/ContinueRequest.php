<?php
class Domain_Message_Factory_ContinueRequest {
    
    /**
     * Создаёт сообщение
     * @param Domain_Collection_Part $partCollection коллекция частей урока
     * @param Domain_Message_Item_LessonPresentation $lessonPresentation показ урока
     * @param Domain_Teacher $teacher учитель
     * @return Domain_Message_Item_ContinueRequest
     */
    public function makeMessage(
        Domain_Collection_Part $partCollection,
        Domain_Message_Item_LessonPresentation $lessonPresentation,
        Domain_Teacher $teacher
    ) {
        
        return new Domain_Message_Item_ContinueRequest(
            $partCollection,
            $lessonPresentation,
            $teacher
        );
        
    }
    
}
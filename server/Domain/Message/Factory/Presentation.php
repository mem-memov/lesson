<?php
class Domain_Message_Factory_Presentation {
    
    /**
     * Создаёт сообщение
     * @param Domain_Message_Item_LessonPresentation $lessonPresentation показ урока
     * @param Domain_Message_Item_PartPresentation $partPresentation показ части урока
     * @param Domain_Message_Item_PartAnnouncement|null $nextPartAnnouncement анонс следующей части урока
     * @param Domain_Exception[] $problems проблемы, возникшие во время посещения части урока урока
     * @return Domain_Message_Item_Presentation
     */
    public function makeMessage(
        Domain_Message_Item_LessonPresentation $lessonPresentation,
        Domain_Message_Item_PartPresentation $partPresentation = null,
        Domain_Message_Item_PartAnnouncement $nextPartAnnouncement = null,
        array $problems = array()
    ) {
        
        return new Domain_Message_Item_Presentation(
            $lessonPresentation,
            $partPresentation,
            $nextPartAnnouncement,
            $problems
        );
        
    }
    
}
<?php
class Domain_Message_Factory_Presentation {
    
    /**
     * Создаёт сообщение
     * @param Domain_Message_Item_LessonPresentation $lessonPresentation показ урока
     * @param Domain_Message_Item_PartPresentation $partPresentation показ части урока
     * @return Domain_Message_Item_Presentation
     */
    public function makeMessage(
        Domain_Message_Item_LessonPresentation $lessonPresentation,
        Domain_Message_Item_PartPresentation $partPresentation
    ) {
        
        return new Domain_Message_Item_Presentation(
            $lessonPresentation,
            $partPresentation
        );
        
    }
    
}
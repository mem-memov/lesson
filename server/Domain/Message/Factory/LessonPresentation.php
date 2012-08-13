<?php
class Domain_Message_Factory_LessonPresentation {
    
    /**
     * Создаёт сообщение
     * @param integer $lessonId ID урока
     * @param string $title название урока
     * @param string $description описание урока
     * @return Domain_Message_Item_LessonPresentation
     */
    public function makeMessage(
        $lessonId,
        $title,
        $description
    ) {
        
        return new Domain_Message_Item_LessonPresentation(
            $lessonId,
            $title,
            $description
        );
        
    }
    
}
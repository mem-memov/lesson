<?php
class Domain_Message_Factory_LessonPresentation {
    
    /**
     * Создаёт сообщение
     * @param integer $lessonId ID урока
     * @param string $title название урока
     * @param string $description описание урока
     * @param integer[] $partIds ID частей урока
     * @param integer стоимость всего урока
     * @return Domain_Message_Lesson_Response_LessonPresentation
     */
    public function makeMessage(
        $lessonId,
        $title,
        $description,
        array $partIds,
        $totalPrice
    ) {
        
        return new Domain_Message_Lesson_Response_LessonPresentation(
            $lessonId,
            $title,
            $description,
            $partIds,
            $totalPrice
        );
        
    }
    
}
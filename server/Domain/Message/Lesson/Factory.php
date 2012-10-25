<?php
class Domain_Message_Lesson_Factory {

    /**
     * Создаёт запрос на продолжение урока
     * @param Domain_Collection_Part $partCollection коллекция частей урока
     * @param Domain_Message_Lesson_Response_LessonPresentation $lessonPresentation показ урока
     * @param Domain_Teacher $teacher учитель
     * @return Domain_Message_Visit_Request_ContinueRequest
     */
    public function makeContinueRequest(
        Domain_Collection_Part $partCollection,
        Domain_Message_Lesson_Response_LessonPresentation $lessonPresentation,
        Domain_Teacher $teacher
    ) {
        
        return new Domain_Message_Visit_Request_ContinueRequest(
            $partCollection,
            $lessonPresentation,
            $teacher
        );
        
    }
    
    /**
     * Создаёт показ урока
     * @param integer $lessonId ID урока
     * @param string $title название урока
     * @param string $description описание урока
     * @param integer[] $partIds ID частей урока
     * @param integer стоимость всего урока
     * @return Domain_Message_Lesson_Response_LessonPresentation
     */
    public function makeLessonPresentation(
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
    
    /**
     * Создаёт инспектора частей урока
     * @return Domain_Message_Part_Request_PartInspector
     */
    public function makePartInspector() {
        
        return new Domain_Message_Part_Request_PartInspector();
        
    }
    
    /**
     * Создаёт запрос на изменение части урока
     * @param integer $price цена
     * @param integer $order номер по порядку
     * @return Domain_Message_Part_Request_PartUpdateRequest
     */
    public function makePartUpdateRequest($price, $order) {
        
        return new Domain_Message_Part_Request_PartUpdateRequest($price, $order);
        
    }
    
}
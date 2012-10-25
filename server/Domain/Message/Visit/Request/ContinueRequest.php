<?php
/**
 * Запрос на продолжение урока
 */
class Domain_Message_Visit_Request_ContinueRequest {
    
    /**
     * Коллекция частей урока
     * @var Domain_Collection_Part
     */
    private $partCollection;
    
    /**
     * Показ урока
     * @var Domain_Message_Lesson_Response_LessonPresentation
     */
    private $lessonPresentation;
    
    /**
     * Учитель
     * @var Domain_Teacher
     */
    private $teacher;
    
    /**
     * Создаёт экземпляр класса
     * @param Domain_Collection_Part $partCollection коллекция частей урока
     * @param Domain_Message_Lesson_Response_LessonPresentation $lessonPresentation показ урока
     * @param Domain_Teacher $teacher учитель
     */
    public function __construct(
        Domain_Collection_Part $partCollection,
        Domain_Message_Lesson_Response_LessonPresentation $lessonPresentation,
        Domain_Teacher $teacher
    ) {
        
        $this->partCollection = $partCollection;
        $this->lessonPresentation = $lessonPresentation;
        $this->teacher = $teacher;
        
    }
    
    /**
     * Передаёт коллекцию частей урока
     * @return Domain_Collection_Part
     */
    public function getPartCollection() {
        
        return $this->partCollection;
        
    }
    
    /**
     * Передаёт показ урока
     * @return Domain_Message_Lesson_Response_LessonPresentation
     */
    public function getLessonPresentation() {
        
        return $this->lessonPresentation;
        
    }
    
    /**
     * Сообщает учителя
     * @return Domain_Teacher
     */
    public function getTeacher() {
        
        return $this->teacher;
        
    }
    
}
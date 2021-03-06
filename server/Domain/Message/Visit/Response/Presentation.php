<?php
/**
 * Показ
 */
class Domain_Message_Visit_Response_Presentation 
implements
    Domain_Message_PresentingInterface
{
    
    /**
     * Показ урока
     * @var Domain_Message_Lesson_Response_LessonPresentation 
     */
    private $lessonPresentation;
    
    /**
     * Показ части урока
     * @var Domain_Message_Part_Response_PartPresentation
     */
    private $partPresentation;
    
    /**
     * Анонс следующей части урока
     * @var Domain_Message_Part_Response_PartAnnouncement
     */
    private $nextPartAnnouncement;
    
    /**
     * Проблемы, возникшие во время посещения части урока
     * @var Domain_Exception[]
     */
    private $problems;
    
    /**
     * Создаёт экземпляр класса
     * @param Domain_Message_Lesson_Response_LessonPresentation $lessonPresentation показ урока
     * @param Domain_Message_Part_Response_PartPresentation|null $partPresentation показ части урока
     * @param Domain_Message_Part_Response_PartAnnouncement|null $nextPartAnnouncement анонс следующей части урока
     * @param Domain_Exception[] $problems проблемы, возникшие во время посещения части урока
     */
    public function __construct(
        Domain_Message_Lesson_Response_LessonPresentation $lessonPresentation,
        Domain_Message_Part_Response_PartPresentation $partPresentation = null,
        Domain_Message_Part_Response_PartAnnouncement $nextPartAnnouncement = null,
        array $problems = array()
    ) {
        
        $this->lessonPresentation = $lessonPresentation;
        $this->partPresentation = $partPresentation;
        $this->nextPartAnnouncement = $nextPartAnnouncement;
        $this->problems = $problems;
        
    }
    
    /**
     * Сообщает, можно ли продолжить показ
     * @return boolean
     */
    public function canBeContinued() {
        
        return !is_null($this->partPresentation);
        
    }
    
    /**
     * Преобразует в массив
     * @return array
     */
    public function toArray() {
        
        return array(
            'lesson' => $this->lessonPresentation->toArray(),
            'part' => $this->partPresentation->toArray(),
            'next_part' => !is_null($this->nextPartAnnouncement) ? $this->nextPartAnnouncement->toArray() : false
        );
        
    }
    
    /**
     * Сообщает о том, возникли ли проблемы во время посещения учеником части урока
     * @return boolean
     */
    public function hasProblems() {
        
        return !empty($this->problems);
        
    }
    
    /**
     * Сообщает о проблемах, которые возникли во время посещения учеником части урока
     * @return Domain_Exception[]
     */
    public function getProblems() {
        
        return $this->problems;
        
    }
    
}
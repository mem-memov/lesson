<?php
/**
 * Показ
 */
class Domain_Message_Item_Presentation 
implements
    Domain_Message_Item_PresentingInterface
{
    
    /**
     * Показ урока
     * @var Domain_Message_Item_LessonPresentation 
     */
    private $lessonPresentation;
    
    /**
     * Показ части урока
     * @var Domain_Message_Item_PartPresentation
     */
    private $partPresentation;
    
    /**
     * Анонс следующей части урока
     * @var Domain_Message_Item_PartAnnouncement
     */
    private $nextPartAnnouncement;
    
    /**
     * Создаёт экземпляр класса
     * @param Domain_Message_Item_LessonPresentation $lessonPresentation показ урока
     * @param Domain_Message_Item_PartPresentation $partPresentation показ части урока
     * @param Domain_Message_Item_PartAnnouncement|null $nextPartAnnouncement анонс следующей части урока
     */
    public function __construct(
        Domain_Message_Item_LessonPresentation $lessonPresentation,
        Domain_Message_Item_PartPresentation $partPresentation,
        Domain_Message_Item_PartAnnouncement $nextPartAnnouncement = null
    ) {
        
        $this->lessonPresentation = $lessonPresentation;
        $this->partPresentation = $partPresentation;
        $this->nextPartAnnouncement = $nextPartAnnouncement;
        
    }
    
    /**
     * Сообщает, можно ли продолжить показ
     * @return boolean
     */
    public function canBeContinued() {
        
        return !is_null($this->nextPartAnnouncement);
        
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
    
}
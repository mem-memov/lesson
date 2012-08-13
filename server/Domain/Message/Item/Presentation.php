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
     * Создаёт экземпляр класса
     * @param Domain_Message_Item_LessonPresentation $lessonPresentation показ урока
     * @param Domain_Message_Item_PartPresentation $partPresentation показ части урока
     */
    public function __construct(
        Domain_Message_Item_LessonPresentation $lessonPresentation,
        Domain_Message_Item_PartPresentation $partPresentation
    ) {
        
        $this->lessonPresentation = $lessonPresentation;
        $this->partPresentation = $partPresentation;
        
    }
    
    /**
     * Преобразует в массив
     * @return array
     */
    public function toArray() {
        
        return array(
            'lesson' => $this->lessonPresentation->toArray(),
            'part' => $this->partPresentation->toArray()
        );
        
    }
    
}
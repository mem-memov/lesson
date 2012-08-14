<?php
/**
 * Показ урока
 */
class Domain_Message_Item_LessonPresentation 
implements
    Domain_Message_Item_PresentingInterface
{
    
    /**
     * ID урока
     * @var integer
     */
    private $lessonId;
    
    /**
     * Название урока
     * @var string
     */
    private $title;
    
    /**
     * Описание урока
     * @var string
     */
    private $description;
    
    /**
     * Создаёт экземпляр класса
     * @param integer $lessonId ID урока
     * @param string $title название урока
     * @param string $description описание урока
     */
    public function __construct(
        $lessonId,
        $title,
        $description
    ) {
        
        $this->lessonId = $lessonId;
        $this->title = $title;
        $this->description = $description;
        
    }
    
    /**
     * Преобразует в массив
     * @return array
     */
    public function toArray() {
        
        return array(
            'lesson_id' => $this->lessonId,
            'title' => $this->title,
            'description' => $this->description
        );
        
    }
    
}
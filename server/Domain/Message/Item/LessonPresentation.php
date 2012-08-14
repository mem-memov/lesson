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
     * ID частей урока
     * @var integer[]
     */
    private $partIds;
    
    /**
     * Стоимость всего урока
     * @var integer
     */
    private $totalPrice;
    
    /**
     * Создаёт экземпляр класса
     * @param integer $lessonId ID урока
     * @param string $title название урока
     * @param string $description описание урока
     * @param integer[] $partIds ID частей урока
     * @param integer стоимость всего урока
     */
    public function __construct(
        $lessonId,
        $title,
        $description,
        array $partIds,
        $totalPrice
    ) {
        
        $this->lessonId = $lessonId;
        $this->title = $title;
        $this->description = $description;
        $this->partIds = $partIds;
        $this->totalPrice = $totalPrice;
        
    }
    
    /**
     * Преобразует в массив
     * @return array
     */
    public function toArray() {
        
        return array(
            'lesson_id' => $this->lessonId,
            'title' => $this->title,
            'description' => $this->description,
            'part_ids' => $this->partIds,
            'total_price' => $this->totalPrice
        );
        
    }
    
}
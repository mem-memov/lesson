<?php
/**
 * Запрос на продолжение урока
 */
class Domain_Message_Item_ContinueRequest {
    
    /**
     * Коллекция частей урока
     * @var Domain_Collection_Part
     */
    private $partCollection;
    
    /**
     * Показ урока
     * @var Domain_Message_Item_LessonPresentation
     */
    private $lessonPresentation;
    
    /**
     * Создаёт экземпляр класса
     * @param Domain_Collection_Part $partCollection коллекция частей урока
     * @param Domain_Message_Item_LessonPresentation $lessonPresentation показ урока
     */
    public function __construct(
        Domain_Collection_Part $partCollection,
        Domain_Message_Item_LessonPresentation $lessonPresentation
    ) {
        
        $this->partCollection = $partCollection;
        $this->lessonPresentation = $lessonPresentation;
        
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
     * @return Domain_Message_Item_LessonPresentation
     */
    public function getLessonPresentation() {
        
        return $this->lessonPresentation;
        
    }
    
}
<?php
/**
 * Текстовая часть урока
 */
class Data_State_Item_Part_Text extends Data_State_Item_Part_Abstract {
    
    /**
     * ID урока
     * @var integer
     */
    private $lessonId;
    public function setLessonId($lessonId) {
        $this->lessonId = $lessonId;
    }
    public function getLessoId() {
        return $this->lessonId;
    }
    
    /**
     * Текст
     * @var string
     */
    private $text;
    public function setText($text) {
        $this->text = $text;
    }
    public function getText() {
        return $this->text;
    }
    
}
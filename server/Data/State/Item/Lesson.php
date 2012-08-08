<?php
/**
 * Состояние урка
 */
class Data_State_Item_Lesson extends Data_State_Item_Abstract {
    
    /**
     * Название урока
     * @var string
     */
    private $title;
    public function setTitle($title) {
        $this->title = $title;
    }
    public function getTitle() {
        return $this->title;
    }
    
    /**
     * Описание урока
     * @var string
     */
    private $description;
    public function setDescription($description) {
        $this->description = $description;
    }
    public function getDescription() {
        return $this->description;
    }
    
    /**
     * ID учителя
     * @var string
     */
    private $teacherId;
    public function setTeacherId($teacherId) {
        $this->teacherId = $teacherId;
    }
    public function getTeacherId() {
        return $this->teacherId;
    }
    
}

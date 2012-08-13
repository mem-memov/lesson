<?php
/**
 * Состояние урка
 */
class Data_State_Item_Lesson extends Data_State_Item_Abstract {
    
    /**
     * Название урока
     * @var string
     */
    private $title = null;
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
    private $description = null;
    public function setDescription($description) {
        $this->description = $description;
    }
    public function getDescription() {
        return $this->description;
    }
    
    /**
     * ID учителя
     * @var integer
     */
    private $teacherId = null;
    public function setTeacherId($teacherId) {
        $this->teacherId = $teacherId;
    }
    public function getTeacherId() {
        return $this->teacherId;
    }
    
}

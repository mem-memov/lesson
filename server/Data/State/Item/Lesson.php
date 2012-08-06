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
    
}

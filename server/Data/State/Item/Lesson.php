<?php
class Data_State_Lesson_Item extends Data_State_Item_Abstract {
    
    private $title;
    public function setTitle($title) {
        $this->title = $title;
    }
    public function getTitle() {
        return $this->title;
    }
    
}

<?php
/**
 * Текстовая часть урока
 */
class Data_State_Item_Part_Text extends Data_State_Item_Part_Abstract {
    
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
<?php
/**
 * Текст
 */
class Data_State_Item_Text extends Data_State_Item_Abstract {
    
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
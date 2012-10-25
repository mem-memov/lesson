<?php
class Domain_Message_Text_Factory {

    /**
     * Создаёт презентацию текста
     * @param integer $textId ID текста
     * @param string $text текст
     * @return Domain_Message_Text_Response_TextPresentation
     */
    public function makeTextPresentation(
        $textId,
        $text
    ) {
        
        return new Domain_Message_Text_Response_TextPresentation(
            $textId,
            $text
        );
        
    }

    
}
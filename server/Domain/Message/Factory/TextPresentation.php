<?php
class Domain_Message_Factory_TextPresentation {
    
    /**
     * Создаёт сообщение
     * @param integer $textId ID текста
     * @param string $text текст
     * @return Domain_Message_Text_Response_TextPresentation
     */
    public function makeMessage(
        $textId,
        $text
    ) {
        
        return new Domain_Message_Text_Response_TextPresentation(
            $textId,
            $text
        );
        
    }
    
}
<?php
/**
 * Показ текста
 */
class Domain_Message_Text_Response_TextPresentation 
implements
    Domain_Message_PresentingInterface
{
    
    /**
     * ID текста
     * @var integer
     */
    private $textId;
    
    /**
     * Текст
     * @var string
     */
    private $text;
    
    /**
     * Создаёт экземпляр класса
     * @param integer $textId ID текста
     * @param string $text текст
     */
    public function __construct(
        $textId,
        $text
    ) {
        
        $this->textId = $textId;
        $this->text = $text;
        
    }
    
    /**
     * Преобразует в массив
     * @return array
     */
    public function toArray() {
        
        return array(
            'text_id' => $this->textId,
            'text' => $this->text
        );
        
    }
    
}
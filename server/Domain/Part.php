<?php
class Domain_Part {
    
    private $state;

    /**
     * Коллекция тексов
     * @var Domain_Collection_Text
     */
    private $textCollection;
    
    public function __construct(
        Data_State_Item_Part $state,
        Domain_Collection_Text $textCollection
    ) {
        
        $this->state = $state;
        $this->textCollection = $textCollection;
        
    }
    
    public function getId() {
        
        return $this->state->getId();
        
    }
    
    public function setOrder($order) {
        
        $this->state->setOrder($order);
        
    }
    
    public function setPrice($price) {
        
        $this->state->setPrice($price);
        
    }
    
    public function addText($textString) {

        $text = $this->textCollection->create($textString);
        $this->textCollection->update($text);
        
        $widgetIds = $this->state->getWidgetIds();
        $widgetTypeIds = $this->state->getWidgetTypeIds();

        $widgetIds[] = $text->getId();
        $widgetTypeIds[] = get_class($text);
        
        $this->state->setWidgetIds($widgetIds);
        $this->state->setWidgetTypeIds($widgetTypeIds);
        
        
    }
    
}
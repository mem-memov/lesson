<?php
class Domain_Lesson {
    
    /**
     * Сосояние
     * @var Data_State_Item_Lesson 
     */
    private $state;
    
    /**
     * Коллекция частей урока
     * @var Domain_Collection_Part
     */
    private $partCollection;
    
    public function __construct(
        Data_State_Item_Lesson $state,
        Domain_Collection_Part $partCollection
    ) {
        
        $this->state = $state;
        $this->partCollection = $partCollection;
      
    }
    
    public function getId() {
        
        return $this->state->getId();
        
    }
    
    public function getTitle() {
        
        return $this->state->getTitle();
        
    }
    
    public function setTitle($title) {
        
        return $this->state->setTitle($title);
        
    }
    
    public function getDescription() {
        
        return $this->state->getDescription();
        
    }
    
    public function setDescription($description) {
        
        return $this->state->setDescription($description);
        
    }
    
    public function getPartIds() {
        
        return $this->state->getPartIds();
        
    }
    
    public function toArray() {
        return array(
            'id' => $this->state->hasId() ? $this->state->getId() : null,
            'title' => $this->state->getTitle(),
            'description' => $this->state->getDescription()
        );
    }
    
    public function showPart($partId) {
        
        $part = $this->partCollection->readUsingId($partId);
        $part instanceof Domain_CanBeShown;
        return $part->show();
        
    }
    
    public function addPart($price, $after = null) {
        
        $part = $this->partCollection->create(
            $this->state->getId()
        );
        
        $partCount = count($this->state->getPartIds());

        $part->setOrder($partCount + 1);
        $part->setPrice($price);
        
        $this->partCollection->update($part);
        
        return $part->getId();
       
    }
    
    public function insertText($partId, $textString) {
     
        $part = $this->partCollection->readUsingId($partId);
        $part->addText($textString);
        $this->partCollection->update($part);

    }
    
}

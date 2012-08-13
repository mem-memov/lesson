<?php
class Domain_Lesson {
    
    /**
     * Состояние
     * @var Data_State_Item_Lesson 
     */
    private $state;
    
    /**
     * Коллекция частей урока
     * @var Domain_Collection_Part
     */
    private $partCollection;
    
    /**
     * Коллекция посещений
     * @var Domain_Collection_Visit
     */
    private $visitCollection;
    
    /**
     * ID ученика
     * @var integer
     */
    private $studentId;

    
    public function __construct(
        Data_State_Item_Lesson $state,
        Domain_Collection_Part $partCollection,
        Domain_Collection_Visit $visitCollection
    ) {
        
        $this->state = $state;
        $this->partCollection = $partCollection;
        $this->visitCollection = $visitCollection;
      
    }

    public function bePresented(
        Domain_Message_Item_PresentationRequest $presentationRequest
    ) {
        
        
        
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
    
    public function getTeacherId() {
        
        return $this->state->getTeacherId();
        
    }
    
    public function hasNextPartId($partId) {
        
        $partIds = $this->state->getPartIds();
        $partCount = count($partIds);
        
        if ($partCount == 0) {
            return false;
        }
        
        $index = array_search($partId, $partIds);
        
        if ($index === false) {
            throw new Domain_Exception('Такой части в уроке нет.');
        }
        
        $maxIndex = $partCount - 1;
        
        return $index < $maxIndex;
        
    }
    
    public function getNextPartId($partId = null) {

        $partIds = $this->state->getPartIds();
        
        if (is_null($partId)) {
            
            $nextPartId = $partIds[0];
            
        } else {
            
            if (!$this->hasNextPartId($partId)) {
                throw new Domain_Exception('Следующей части урока нет.');
            }
            
            $index = array_search($partId, $partIds);
            $nextPartId = $partIds[$index + 1];
            
        }
        
        return $nextPartId;
        
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

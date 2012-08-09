<?php
class Domain_Lesson {
    
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
    
    public function toArray() {
        return array(
            'id' => $this->state->hasId() ? $this->state->getId() : null,
            'title' => $this->state->getTitle(),
            'description' => $this->state->getDescription()
        );
    }
    
    public function appendPart(array $partArray) {
        
        $part = $this->partCollection->create(
            $partArray['price'], 
            $partArray['order'],
            $partArray['lesson_id']
        );
        
        $this->partCollection->update($part);
       
    }
    
}

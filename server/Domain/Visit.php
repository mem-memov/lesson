<?php
class Domain_Visit {
    
    private $state;
    
    /**
     * Коллекция частей урока
     * @var Domain_Collection_Part
     */
    private $partCollection;
    
    public function __construct(
        Data_State_Item_Visit $state,
        Domain_Collection_Part $partCollection
    ) {
        
        $this->state = $state;
        $this->partCollection = $partCollection;
        
    }
    
    public function continuePresentation(
        Domain_Message_Item_ContinueRequest $continueRequest
    ) {
        
        $curren
        $part = 
        Domain_Collection_Exception_LessonCanNotContinue
        
    }
    
}
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
        
        $partIds = $continueRequest->getPartIds();
        
        $maxIndex = count($partIds) - 1;
        
        $index = array_search($this->state->getPartId(), $partIds);
        
        if ($index == false) {
            throw new Domain_Exception_PartIsMissing();
        }
        
        if ($index == $maxIndex) {
            throw new Domain_Collection_Exception_LessonCanNotContinue();
        }
        
        $part = $this->partCollection->readUsingId( $this->state->getPartId() );
        
        $nextPartId = $partIds[$index + 1];
        
        $this->state->setPartId($nextPartId);
        
        
    }
    
}
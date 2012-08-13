<?php
class Domain_Visit {
    
    private $state;
    
    /**
     * Фабрика запросов на идентификацию части урока
     * @var Domain_Message_Factory_PartIdentificationRequest
     */
    private $partIdentificationRequestFactory;

    
    public function __construct(
        Data_State_Item_Visit $state,
        Domain_Message_Factory_PartIdentificationRequest $partIdentificationRequestFactory
    ) {
        
        $this->state = $state;
        $this->partIdentificationRequestFactory = $partIdentificationRequestFactory;
        
    }
    
    public function continuePresentation(
        Domain_Message_Item_ContinueRequest $continueRequest
    ) {

        $partCollection = $continueRequest->getPartCollection();
        
        $parts = $partCollection->readUsingLessonId( $this->state->getLessonId() );
        
        $oldPart = $partCollection->readUsingId( $this->state->getPartId() );

        $maxIndex = count($parts) - 1;

        $index = array_search($oldPart, $parts, true);

        if ($index === false) {
            throw new Domain_Exception_PartIsMissing();
        }

        if ($index === $maxIndex) {
            throw new Domain_Collection_Exception_LessonCanNotContinue();
        }
        
        $newPart = $parts[$index + 1];
        
        $partIdentificationRequest = $this->partIdentificationRequestFactory->makeMessage($this->state);

        $newPart->transferId($partIdentificationRequest);

    }
    
}
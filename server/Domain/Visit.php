<?php
class Domain_Visit {
    
    private $state;
    
    /**
     * Фабрика запросов на идентификацию части урока
     * @var Domain_Message_Factory_PartIdentificationRequest
     */
    private $partIdentificationRequestFactory;
    
    /**
     * Фабрика показа
     * @var Domain_Message_Factory_Presentation
     */
    private $presentationFactory;

    
    public function __construct(
        Data_State_Item_Visit $state,
        Domain_Message_Factory_PartIdentificationRequest $partIdentificationRequestFactory,
        Domain_Message_Factory_Presentation $presentationFactory
    ) {
        
        $this->state = $state;
        $this->partIdentificationRequestFactory = $partIdentificationRequestFactory;
        $this->presentationFactory = $presentationFactory;
        
    }
    
    /**
     * 
     * @param Domain_Message_Item_ContinueRequest $continueRequest
     * @return Domain_Message_Item_Presentation
     * @throws Domain_Exception_PartIsMissing
     */
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

        $newPartAnnouncement = null;
        if ($index < $maxIndex) {
            
            $newPart = $parts[$index + 1];
            $partIdentificationRequest = $this->partIdentificationRequestFactory->makeMessage($this->state);
            $newPart->transferId($partIdentificationRequest);
            $newPartAnnouncement = $newPart->beAnnounced();
            
        }

        $oldPart instanceof Domain_CanBePresented;
        $oldPartPresentation = $oldPart->bePresented();

        $presentation = $this->presentationFactory->makeMessage(
            $continueRequest->getLessonPresentation(), 
            $oldPartPresentation, 
            $newPartAnnouncement
        );

        return $presentation;

    }
    
}
<?php
class Domain_Visit {
    
    private $state;
    
    /**
     * Коллекция учеников
     * @var Domain_Collection_Student
     */
    private $studentCollection;
    
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

    /**
     * Фабрика запросов на изучение части урока
     * @var Domain_Message_Factory_LearnRequest
     */
    private $learnRequestFactory;
    
    
    public function __construct(
        Data_State_Item_Visit $state,
        Domain_Collection_Student $studentCollection,
        Domain_Message_Factory_PartIdentificationRequest $partIdentificationRequestFactory,
        Domain_Message_Factory_Presentation $presentationFactory,
        Domain_Message_Factory_LearnRequest $learnRequestFactory
    ) {
        
        $this->state = $state;
        $this->studentCollection = $studentCollection;
        $this->partIdentificationRequestFactory = $partIdentificationRequestFactory;
        $this->presentationFactory = $presentationFactory;
        $this->learnRequestFactory = $learnRequestFactory;
        
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
        
        
        $student = $this->studentCollection->readUsingId( $this->state->getStudentId() );
        $learnRequest = $this->learnRequestFactory->makeMessage($oldPart);
        $student->learn($learnRequest);
        

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
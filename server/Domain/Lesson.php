<?php
/**
 * Урок
 */
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
     * Фабрика запросов на продолжение урока
     * @var Domain_Message_Factory_ContinueRequest
     */
    private $continueRequestFactory;
    
    /**
     * Фабрика запросов на посещение урока
     * @var Domain_Message_Factory_VisitRequest
     */
    private $visitRequestFactory;
    
    public function __construct(
        Data_State_Item_Lesson $state,
        Domain_Collection_Part $partCollection,
        Domain_Collection_Visit $visitCollection,
        Domain_Message_Factory_ContinueRequest $continueRequestFactory,
        Domain_Message_Factory_VisitRequest $visitRequestFactory
    ) {
        
        $this->state = $state;
        $this->partCollection = $partCollection;
        $this->visitCollection = $visitCollection;
        $this->continueRequestFactory = $continueRequestFactory;
        $this->visitRequestFactory = $visitRequestFactory;
      
    }

    /**
     * 
     * @param Domain_Message_Item_PresentationRequest $presentationRequest
     * @return type
     */
    public function bePresented(
        Domain_Message_Item_PresentationRequest $presentationRequest
    ) {
        
        try {
            
            $visit = $this->visitCollection->readForVisitingStudent(
                $this->state->getId(),
                $presentationRequest->getStudentId()
            );
            
        }
        catch (Domain_Collection_Exception_StudentIsAbsent $exception) {
            
            $this->visitFirstPart( $presentationRequest->getStudentId() );
            
            $visit = $this->visitCollection->readForVisitingStudent(
                $this->state->getId(),
                $presentationRequest->getStudentId()
            );
            
        }
        
        try {
            
            $continueRequest = $this->continueRequestFactory->makeMessage( $this->state->getPartIds() );
            $presentationResponce = $visit->continuePresentation($continueRequest);
        
        }
        catch (Domain_Collection_Exception_LessonCanNotContinue $exception) {
            
            
            
        }
        
        return $presentationResponce;

    }
    
    public function visitFirstPart($studentId) {
        
        $parts = $this->partCollection->readUsingLessonId( $this->state->getId() );
        
        if (empty($parts)) {
            throw new Domain_Exception_LessonIsEmpty();
        }
        
        $firstPart = $parts[0];
        
        $firstPart instanceof Domain_Part;
        
        $visitRequest = $this->visitRequestFactory->makeMessage(
                                                                $studentId, 
                                                                $this->state->getId()
        );
        
        $firstPart->startVisit($visitRequest);
            
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

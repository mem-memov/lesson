<?php
/**
 * Урок
 */
class Domain_Lesson 
implements
    Domain_CanBePresented
{
    
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
    
    /**
     * Фабрика показов уроков
     * @var Domain_Message_Factory_LessonPresentation 
     */
    private $presentationFactory;
    
    public function __construct(
        Data_State_Item_Lesson $state,
        Domain_Collection_Part $partCollection,
        Domain_Collection_Visit $visitCollection,
        Domain_Message_Factory_ContinueRequest $continueRequestFactory,
        Domain_Message_Factory_VisitRequest $visitRequestFactory,
        Domain_Message_Factory_LessonPresentation $presentationFactory
    ) {
        
        $this->state = $state;
        $this->partCollection = $partCollection;
        $this->visitCollection = $visitCollection;
        $this->continueRequestFactory = $continueRequestFactory;
        $this->visitRequestFactory = $visitRequestFactory;
        $this->presentationFactory = $presentationFactory;
      
    }
    
    public function bePresented() {
        
        return $this->presentationFactory->makeMessage(
            $this->state->getId(), 
            $this->state->getTitle(), 
            $this->state->getDescription()
        );
        
    }

    /**
     * 
     * @param Domain_Message_Item_PresentationRequest $presentationRequest
     * @return Domain_Message_Item_Presentation
     */
    public function goOn(
        Domain_Message_Item_PresentationRequest $presentationRequest
    ) {
        
        $lessonPresentation = $this->bePresented();

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
        
            
        $continueRequest = $this->continueRequestFactory->makeMessage( 
                $this->partCollection,
                $lessonPresentation
        );
        $presentation = $visit->continuePresentation($continueRequest);
        
        if ($presentation->canBeContinued()) {
            $this->visitCollection->update($visit);
        } else {
            $this->visitCollection->delete($visit);
        }

        
        return $presentation;

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
                                                                $this->state->getTeacherId()
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

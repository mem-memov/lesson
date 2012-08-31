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
     * Фабрика сообщений
     * @var Domain_Message_Lesson_Factory 
     */
    private $messageFactory;
    
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
    
    public function __construct(
        Data_State_Item_Lesson $state,
        Domain_Message_Lesson_Factory $messageFactory,
        Domain_Collection_Part $partCollection,
        Domain_Collection_Visit $visitCollection
    ) {
        
        $this->state = $state;
        $this->messageFactory = $messageFactory;
        $this->partCollection = $partCollection;
        $this->visitCollection = $visitCollection;
      
    }
    
    public function bePresented() {
        
        $parts = $this->partCollection->readUsingLessonId( $this->state->getId() );
        
        $partInspector = $this->messageFactory->makePartInspector();
        
        foreach ($parts as $part) {
            $part->beInspected($partInspector);
        }
        
        return $this->messageFactory->makeLessonPresentation(
            $this->state->getId(), 
            $this->state->getTitle(), 
            $this->state->getDescription(),
            $partInspector->getPartIds(),
            $partInspector->getTotalPrice()
        );
        
    }

    /**
     * 
     * @param Domain_Message_Lesson_Request_PresentationRequest $presentationRequest
     * @return Domain_Message_Item_Presentation
     */
    public function goOn(
        Domain_Message_Lesson_Request_PresentationRequest $presentationRequest
    ) {
        
        $lessonPresentation = $this->bePresented();

        try {
            
            $visit = $this->visitCollection->readForVisitingStudent(
                $this->state->getId(),
                $presentationRequest->getStudentId()
            );

        }
        catch (Domain_Collection_Exception_StudentIsAbsent $exception) {

            $visit = $this->visitCollection->create(
                $presentationRequest->getStudentId(), 
                $this->state->getTeacherId(),
                $this->state->getId()
            );

        }
        
            
        $continueRequest = $this->messageFactory->makeContinueRequest( 
                $this->partCollection,
                $lessonPresentation,
                $presentationRequest->getTeacher()
        );
        $presentation = $visit->continuePresentation($continueRequest);
        
        if ($presentation->canBeContinued()) {
            $this->visitCollection->update($visit);
        } else {
            $this->visitCollection->delete($visit);
        }

        
        return $presentation;

    }

    public function showPart($partId) {
        
        $part = $this->partCollection->readUsingId($partId);
        
        if (!$part->belongsToLesson( $this->state->getId() )) {
            throw new DomainException('Часть не принадлежит уроку. Она не будет показана.');
        }
        
        $partPresentation = $part->bePresented();
        
        return $partPresentation->toArray();
        
    }

    public function addPart($price, $after = null) {
        
        $part = $this->partCollection->create(
            $this->state->getId()
        );

        $parts = $this->partCollection->readUsingLessonId( $this->state->getId() );

        $partCount = count($parts);

        $order = $partCount + 1;
        
        $updateRequest = $this->messageFactory->makePartUpdateRequest($price, $order);
        $part->beUpdated($updateRequest);
        
        $this->partCollection->update($part);
        
        $partInspector = $this->messageFactory->makePartInspector();
        $part->beInspected($partInspector);
        
        $partId = array_pop($partInspector->getPartIds());
        
        return $partId;
       
    }
    
    public function insertText($partId, $textString) {
     
        $part = $this->partCollection->readUsingId($partId);
        $part->addText($textString);
        $this->partCollection->update($part);

    }
    
    public function setPartPrice($partId, $price) {
        
        $part = $this->partCollection->readUsingId($partId);
        
        $updateRequest = $this->messageFactory->makePartUpdateRequest($price, null);
        $part->beUpdated($updateRequest);
        $this->partCollection->update($part);
        
    }
    
    public function setDescription($description) {
        
        return $this->state->setDescription($description);
        
    }
    
    public function setTitle($title) {
        
        return $this->state->setTitle($title);
        
    }
    
    public function getId() {
        
        return $this->state->getId();
        
    }
    
}

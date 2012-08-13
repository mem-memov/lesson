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
     * Фабрика запросов на продолжение урока
     * @var Domain_Message_Factory_ContinueRequest
     */
    private $continueRequestFactory;
    
    public function __construct(
        Data_State_Item_Lesson $state,
        Domain_Collection_Part $partCollection,
        Domain_Collection_Visit $visitCollection,
        Domain_Message_Factory_ContinueRequest $continueRequestFactory
    ) {
        
        $this->state = $state;
        $this->partCollection = $partCollection;
        $this->visitCollection = $visitCollection;
        $this->continueRequestFactory = $continueRequestFactory;
      
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
            
            $visit = $this->visitCollection->create(
                    $presentationRequest->getStudentId(), 
                    $this->state->getTeacherId(),
                    $this->state->getId(),
                    $this->getFirstPartId()
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
    
    public function getFirstPartId() {
        
        $partIds = $this->state->getPartIds();
        
        if (empty($partIds)) {
            throw new Domain_Exception_LessonIsEmpty();
        }
        
        return $partIds[0];
        
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

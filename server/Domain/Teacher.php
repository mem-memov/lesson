<?php
class Domain_Teacher {

    /**
     * Сосояние
     * @var Data_State_Item_Teacher 
     */
    private $state;
    
    /**
     * Счёт
     * @var Domain_Account 
     */
    private $account;
    
    /**
     * Коллекция уроков
     * @var Domain_Collection_Lesson
     */
    private $lessonCollection;
    
    /**
     * Фабрика презентационных запросов
     * @var Domain_Message_Factory_PresentationRequest
     */
    private $presentationRequestFactory;
    
    public function __construct(
        Data_State_Item_Teacher $state,
        Domain_Account $account,
        Domain_Collection_Lesson $lessonCollection,
        Domain_Message_Factory_PresentationRequest $presentationRequestFactory
    ) {
        
        $this->state = $state;
        $this->account = $account;
        $this->lessonCollection = $lessonCollection;
        $this->presentationRequestFactory = $presentationRequestFactory;
        
    }
    
    public function getId() {
        
        return $this->state->getId();
        
    }
    
    
    public function teach(
        Domain_Message_Item_EducationRequest $educationRequest
    ) {
        
        $lesson = $this->lessonCollection->readUsingId($educationRequest->getLessonId());
        $presentationRequest = $this->presentationRequestFactory->makeMessage($educationRequest->getStudentId());
        $presentationResponce = $lesson->bePresented($presentationRequest);
        
        return $presentationResponce;
        
    }
    
    public function prepare($lesson = null) {
        
        if (is_null($lesson)) {
            
            $lesson = $this->lessonCollection->create(
                $this->state->getId()
            );
            
        }
        
        $this->lessonCollection->update($lesson);
        
        return $lesson;

    }

    public function canWithdraw($amount) {
        
        return $this->account->canDecrease($amount);
        
    }
    
    public function withdraw($amount) {
        
        $this->account->decrease($amount);
        
    }
    
    private function deposit($amount) {
        
        $this->account->increase($amount);
        
    } 

}

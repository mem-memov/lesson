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
    
    /**
     * Показывает ученику очередную часть урока
     * @param Domain_Message_Item_EducationRequest $educationRequest
     * @return Domain_Message_Item_Presentation
     */
    public function teach(
        Domain_Message_Item_EducationRequest $educationRequest
    ) {
        
        $lesson = $this->lessonCollection->readUsingId($educationRequest->getLessonId());
        $presentationRequest = $this->presentationRequestFactory->makeMessage($educationRequest->getStudentId());
        $presentation = $lesson->goOn($presentationRequest);
        
        return $presentation;
        
    }
    
    /**
     * 
     * @param integer|null $lessonId Null означает, что нужно создать новый урок
     * @param Domain_Lesson|null новый вариант урока
     * @return Domain_Lesson
     */
    public function prepare($lessonId = null, $newVersion = null) {
        
        if (!is_null($newVersion)) {
            
            $this->lessonCollection->update($newVersion);
            return $newVersion;
            
        }
        
        if (is_null($lessonId)) {
            
            $lesson = $this->lessonCollection->create(
                $this->state->getId()
            );
            
        } else {
            
            $lesson = $this->lessonCollection->readUsingId($lessonId);
            
        }
        
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

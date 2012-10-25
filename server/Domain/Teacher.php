<?php
class Domain_Teacher {

    /**
     * Сосояние
     * @var Data_State_Item_Teacher 
     */
    private $state;
    
    /**
     * Фабрика сообщений
     * @var Domain_Message_Teacher_Factory 
     */
    private $messageFactory;
    
    /**
     * Коллекция счетов
     * @var Domain_Collection_Account 
     */
    private $accountCollection;
    
    /**
     * Коллекция уроков
     * @var Domain_Collection_Lesson
     */
    private $lessonCollection;
    
    public function __construct(
        Data_State_Item_Teacher $state,
        Domain_Message_Teacher_Factory $messageFactory,
        Domain_Collection_Account $accountCollection,
        Domain_Collection_Lesson $lessonCollection
    ) {
        
        $this->state = $state;
        $this->messageFactory = $messageFactory;
        $this->accountCollection = $accountCollection;
        $this->lessonCollection = $lessonCollection;
        
    }
    
    /**
     * Показывает ученику очередную часть урока
     * @param Domain_Message_Teacher_Request_EducationRequest $educationRequest
     * @return Domain_Message_Item_Presentation
     */
    public function teach(
        Domain_Message_Teacher_Request_EducationRequest $educationRequest
    ) {
        
        $lesson = $this->lessonCollection->readUsingId($educationRequest->getLessonId());
        $presentationRequest = $this->messageFactory->makePresentationRequest($educationRequest->getStudentId(), $this);
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
            $this->lessonCollection->update($lesson);
            
        } else {
            
            $lesson = $this->lessonCollection->readUsingId($lessonId);
            
        }
        
        return $lesson;

    }
    
    /**
     * Приносит деньги за показ части урока
     * @param Domain_Message_Teacher_Request_EarnRequest $earnRequest
     */
    public function earn(Domain_Message_Teacher_Request_EarnRequest $earnRequest) {
        
        $part = $earnRequest->getPart();
        
        $account = $this->accountCollection->readUsingUserId( $this->state->getId() );
        
        $partMoneyRequest = $this->messageFactory->makePartMoneyRequest( 
            $account, 
            $this->accountCollection
        );
        
        $part->bringMoney($partMoneyRequest);
        
    }


    public function withdraw($amount) {
        
        $this->account->decrease($amount);
        
    }


}

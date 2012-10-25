<?php
class Domain_Visit {
    
    private $state;
    
    /**
     * Фабрика сообщений
     * @var Domain_Message_Visit_Factory 
     */
    private $messageFactory;
    
    /**
     * Коллекция учеников
     * @var Domain_Collection_Student
     */
    private $studentCollection;

    public function __construct(
        Data_State_Item_Visit $state,
        Domain_Message_Visit_Factory $messageFactory,
        Domain_Collection_Student $studentCollection
    ) {
        
        $this->state = $state;
        $this->messageFactory = $messageFactory;
        $this->studentCollection = $studentCollection;
        
    }
    
    /**
     * 
     * @param Domain_Message_Visit_Request_ContinueRequest $continueRequest
     * @return Domain_Message_Item_Presentation
     * @throws Domain_Exception_PartIsMissing
     */
    public function continuePresentation(
        Domain_Message_Visit_Request_ContinueRequest $continueRequest
    ) {

        // создаём контейнер для передачи сообщений об ошибках
        $problems = array();
        

        
        $partCollection = $continueRequest->getPartCollection();
        
        // получаем все части данного урока
        $parts = $partCollection->readUsingLessonId( $this->state->getLessonId() );
        
        // проверяем, что урок содержит части
        if (count($parts) === 0) {
            throw new Domain_Exception_LessonIsEmpty();
        }
        
        // определяем номер последней части урока
        $maxIndex = count($parts) - 1;
    
        // получаем номер текущей части урока
        if (is_null( $this->state->getPartId() )) {
            $currentIndex = 0;
        } else {
            $oldPart = $partCollection->readUsingId( $this->state->getPartId() );
            $oldPartIndex = array_search($oldPart, $parts, true);
            if ($oldPartIndex === false) {
                throw new Domain_Exception_PartIsMissing();
            }
            $currentIndex = $oldPartIndex + 1;
        }

        if ($currentIndex <= $maxIndex) {
            
            // получаем текущую часть урока
            $currentPart = $parts[$currentIndex];
            
            // отмечаем, что эту часть урока ученик посетил
            $partIdentificationRequest = $this->messageFactory->makePartIdentificationRequest($this->state);
            $currentPart->transferId($partIdentificationRequest);

            // ученик обучается
            $student = $this->studentCollection->readUsingId( $this->state->getStudentId() );
            $learnRequest = $this->messageFactory->makeLearnRequest($currentPart);
            try {
                $student->learn($learnRequest);
            }
            catch (Domain_Exception_NotEnoughMoney $exeption) {
                $problems[] = $exeption;
            }

            // учитель преподаёт
            $teacher = $continueRequest->getTeacher();
            $earnRequest = $this->messageFactory->makeEarnRequest($currentPart);
            $teacher->earn($earnRequest);

            // создаём анонс следующей части урока
            $nextPartAnnouncement = null;
            if ($currentIndex < $maxIndex) {

                $nextPart = $parts[$index + 1];
                $nextPartAnnouncement = $nextPart->beAnnounced();

            }

            $currentPart instanceof Domain_CanBePresented;
            $currentPartPresentation = $currentPart->bePresented();

            $presentation = $this->messageFactory->makeLessonPresentation(
                $continueRequest->getLessonPresentation(), 
                $currentPartPresentation, 
                $nextPartAnnouncement,
                $problems
            );

            return $presentation;
            
        } else {
            
            // выпроваживаем ученика с оконченного урока
            $presentation = $this->messageFactory->makeLessonPresentation(
                $continueRequest->getLessonPresentation() // не даём презентацию части
            );
            return $presentation;
            
        }

    }
    
}
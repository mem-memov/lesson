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
    
    /**
     * Фабрика запросов на зарабатывание
     * @var Domain_Message_Factory_EarnRequest
     */
    private $earnRequestFactory;
    
    
    public function __construct(
        Data_State_Item_Visit $state,
        Domain_Collection_Student $studentCollection,
        Domain_Message_Factory_PartIdentificationRequest $partIdentificationRequestFactory,
        Domain_Message_Factory_Presentation $presentationFactory,
        Domain_Message_Factory_LearnRequest $learnRequestFactory,
        Domain_Message_Factory_EarnRequest $earnRequestFactory
    ) {
        
        $this->state = $state;
        $this->studentCollection = $studentCollection;
        $this->partIdentificationRequestFactory = $partIdentificationRequestFactory;
        $this->presentationFactory = $presentationFactory;
        $this->learnRequestFactory = $learnRequestFactory;
        $this->earnRequestFactory = $earnRequestFactory;
        
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
            $partIdentificationRequest = $this->partIdentificationRequestFactory->makeMessage($this->state);
            $currentPart->transferId($partIdentificationRequest);

            // ученик обучается
            $student = $this->studentCollection->readUsingId( $this->state->getStudentId() );
            $learnRequest = $this->learnRequestFactory->makeMessage($currentPart);
            try {
                $student->learn($learnRequest);
            }
            catch (Domain_Exception_NotEnoughMoney $exeption) {
                $problems[] = $exeption;
            }

            // учитель преподаёт
            $teacher = $continueRequest->getTeacher();
            $earnRequest = $this->earnRequestFactory->makeMessage($currentPart);
            $teacher->earn($earnRequest);

            // создаём анонс следующей части урока
            $nextPartAnnouncement = null;
            if ($currentIndex < $maxIndex) {

                $nextPart = $parts[$index + 1];
                $nextPartAnnouncement = $nextPart->beAnnounced();

            }

            $currentPart instanceof Domain_CanBePresented;
            $currentPartPresentation = $currentPart->bePresented();

            $presentation = $this->presentationFactory->makeMessage(
                $continueRequest->getLessonPresentation(), 
                $currentPartPresentation, 
                $nextPartAnnouncement,
                $problems
            );

            return $presentation;
            
        } else {
            
            // выпроваживаем ученика с оконченного урока
            $presentation = $this->presentationFactory->makeMessage(
                $continueRequest->getLessonPresentation() // не даём презентацию части
            );
            return $presentation;
            
        }

    }
    
}
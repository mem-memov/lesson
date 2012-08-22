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
/*
        // выпроваживаем учеников с оконченного урока
        $partId = $this->state->getPartId();
        if (empty($partId)) {
            $presentation = $this->presentationFactory->makeMessage(
                $continueRequest->getLessonPresentation()
            );

            return $presentation;
        }
*/        
        
        
        // создаём контейнер для передачи сообщений об ошибках
        $problems = array();
        

        
        $partCollection = $continueRequest->getPartCollection();
        
        // получаем все части данного урока
        $parts = $partCollection->readUsingLessonId( $this->state->getLessonId() );
        
        // получаем текущую часть урока
        $oldPart = $partCollection->readUsingId( $this->state->getPartId() );

        $maxIndex = count($parts) - 1;

        $index = array_search($oldPart, $parts, true);

        if ($index === false) {
            throw new Domain_Exception_PartIsMissing();
        }
        
        // ученик обучается
        $student = $this->studentCollection->readUsingId( $this->state->getStudentId() );
        $learnRequest = $this->learnRequestFactory->makeMessage($oldPart);
        try {
            $student->learn($learnRequest);
        }
        catch (Domain_Exception_NotEnoughMoney $exeption) {
            $problems[] = $exeption;
        }
        
        // учитель преподаёт
        $teacher = $continueRequest->getTeacher();
        $earnRequest = $this->earnRequestFactory->makeMessage($oldPart);
        $teacher->earn($earnRequest);

        // создаём анонс следующей части урока
        $newPartAnnouncement = null;
        if ($index < $maxIndex) {
            
            $newPart = $parts[$index + 1];
            
            // устанавливаем часть для следующего посещения
            $partIdentificationRequest = $this->partIdentificationRequestFactory->makeMessage($this->state);
            $newPart->transferId($partIdentificationRequest);
            
            // получаем анонс
            $newPartAnnouncement = $newPart->beAnnounced();
            
        } else {
            
            // показываем, что урок окончен
            $this->state->setPartId(null);
            
        }

        $oldPart instanceof Domain_CanBePresented;
        $oldPartPresentation = $oldPart->bePresented();

        $presentation = $this->presentationFactory->makeMessage(
            $continueRequest->getLessonPresentation(), 
            $oldPartPresentation, 
            $newPartAnnouncement,
            $problems
        );

        return $presentation;

    }
    
}
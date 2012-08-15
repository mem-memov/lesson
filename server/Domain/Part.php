<?php
class Domain_Part 
implements
    Domain_CanBePresented
{
    
    private $state;

    /**
     * Коллекция тексов
     * @var Domain_Collection_Text
     */
    private $textCollection;
    
    /**
     * Коллекция посещений
     * @var Domain_Collection_Visit
     */
    private $visitCollection;
    
    /**
     * Индекс типов учебных пособий
     * @var array
     */
    private $widgetIndex;
    
     /**
     * Типы учебных пособий
     * @var array
     */
    private $widgetTypes;
    
    /**
     * Фабрика показов частей урока
     * @var Domain_Message_Factory_PartPresentation 
     */
    private $presentationFactory;
    
    /**
     * Фабрика анонсов частей урока
     * @var Domain_Message_Factory_PartAnnouncement 
     */
    private $announcementFactory;
    
    /**
     * Фабрика  запросов на прикрепление пособия к части урока
     * @var Domain_Message_Factory_PartJoinCall
     */
    private $partJoinCallFactory;
    
    public function __construct(
        Data_State_Item_Part $state,
        Domain_Collection_Text $textCollection,
        Domain_Collection_Visit $visitCollection,
        Domain_Message_Factory_PartPresentation $presentationFactory,
        Domain_Message_Factory_PartAnnouncement $announcementFactory,
        Domain_Message_Factory_PartJoinCall $partJoinCallFactory
    ) {
        
        $this->state = $state;
        $this->textCollection = $textCollection;
        $this->visitCollection = $visitCollection;
        $this->presentationFactory = $presentationFactory;
        $this->announcementFactory = $announcementFactory;
        $this->partJoinCallFactory = $partJoinCallFactory;
        
        $this->widgetIndex = array( // только уникальные соответствия!!!
            1 => 'Domain_Text'
        );
        
        $this->widgetTypes = array( // только уникальные соответствия!!!
            1 => 'text'
        );
        
    }
    
    public function startVisit(
        Domain_Message_Item_VisitRequest $visitRequest
    ) {
        
        $visit = $this->visitCollection->create(
            $visitRequest->getStudentId(), 
            $visitRequest->getTeacherId(),
            $this->state->getLessonId(),
            $this->state->getId()
        );
        
        $this->visitCollection->update($visit);
        
    }
    
    /**
     * Сообщает ID части урокаs
     * @param Domain_Message_Item_PartIdentificationRequest $partIdentificationRequest
     */
    public function transferId(
        Domain_Message_Item_PartIdentificationRequest $partIdentificationRequest
    ) {
        
        $partIdentificationRequest->setPartId( $this->state->getId() );
        
    }
    
    public function bePresented() {
        
        $widgetPresentations = array();
        
        $widgetIds = $this->state->getWidgetIds();
        $widgetTypeIds = $this->state->getWidgetTypeIds();
        
        foreach ($widgetIds as $index => $widgetId) {
            $widget = $this->getWidget($widgetTypeIds[$index], $widgetId);
            $widget instanceof Domain_CanBePresented;
            $widgetPresentations[] = $widget->bePresented();
        }
        
        $widgetTypes = array();
        foreach ($widgetTypeIds as $widgetTypeId) {
            $widgetTypes[] = $this->widgetTypes[$widgetTypeId];
        }
        
        $partPresentation = $this->presentationFactory->makeMessage(
                $this->state->getId(), 
                $this->state->getOrder(),
                $this->state->getPrice(),
                $widgetPresentations,
                $widgetTypes
        );
        
        return $partPresentation;
        
    }
    
    public function beAnnounced() {
        
        $partAnnouncement = $this->announcementFactory->makeMessage(
                $this->state->getId(), 
                $this->state->getOrder(),
                $this->state->getPrice()
        );
        
        return $partAnnouncement;
        
    }
    
    public function beInspected(
        Domain_Message_Item_PartInspector $partInspector
    ) {
        
        $partInspector->addPartId( $this->state->getId() );
        $partInspector->increasePrice( $this->state->getPrice() );
        
    }
    
    public function bePaidFor(
        Domain_Message_Item_PartPaymentRequest $partPaymentRequest
    ) {
        
        $partPaymentRequest->takePrice( $this->state->getPrice() );
        
    }
    
    public function belongsToLesson($lessonId) {
        
        return $this->state->getLessonId() === $lessonId;
        
    }
    
    public function beUpdated(
        Domain_Message_Item_PartUpdateRequest $updateRequest
    ) {
        
        if ( $updateRequest->mustSetPrice() ) {
            
            $this->state->setPrice( $updateRequest->getPrice() );
            
        }
        
        if ( $updateRequest->mustSetOrder() ) {
            
            $this->state->setOrder( $updateRequest->getOrder() );
            
        }
        
        
    }

    public function addText($textString) {

        $text = $this->textCollection->create($textString);
        $this->textCollection->update($text);
        
        $widgetIds = $this->state->getWidgetIds();
        $widgetTypeIds = $this->state->getWidgetTypeIds();

        // дополняет список ID пособий
        $joinCall = $this->partJoinCallFactory->makeMessage($widgetIds);
        $text->joinPart($joinCall);
        $widgetTypeIds[] = $this->getWidgetTypeId($text);

        $this->state->setWidgetIds($widgetIds);
        $this->state->setWidgetTypeIds($widgetTypeIds);
        
        
    }
    
    private function getWidgetTypeId($widget) {

        $class = get_class($widget);
        
        $index = array_search($class, $this->widgetIndex);
        
        if ($index === false) {
            throw new Domain_Exception('Для типа пособия '.$class.' не определён цифровой код.');
        }
        
        return $index;

    }
    
    private function getWidget($typeId, $id) {
        
        if (!array_key_exists($typeId, $this->widgetIndex)) {
            throw new Domain_Exception('Неизвестный тип пособия - '.$typeId.'.');
        }
        
        $class = $this->widgetIndex[$typeId];
        
        switch ($class) {
            
            case 'Domain_Text':
                $widget = $this->textCollection->readUsingId($id);
                break;
            default:
                throw new Domain_Exception('Неизвестна коллекция для класса пособия - '.$class.'.');
                break;
            
        }
        
        return $widget;
        
    }
    
}
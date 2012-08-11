<?php
class Domain_Part 
implements
    Domain_CanBeShown
{
    
    private $state;

    /**
     * Коллекция тексов
     * @var Domain_Collection_Text
     */
    private $textCollection;
    
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
    
    public function __construct(
        Data_State_Item_Part $state,
        Domain_Collection_Text $textCollection
    ) {
        
        $this->state = $state;
        $this->textCollection = $textCollection;
        
        $this->widgetIndex = array( // только уникальные соответствия!!!
            1 => 'Domain_Text'
        );
        
        $this->widgetTypes = array( // только уникальные соответствия!!!
            1 => 'text'
        );
        
    }
    
    public function getId() {
        
        return $this->state->getId();
        
    }
    
    public function setOrder($order) {
        
        $this->state->setOrder($order);
        
    }
    
    public function setPrice($price) {
        
        $this->state->setPrice($price);
        
    }
    
    public function show() {
        
        $data = array(
            'part_id' => $this->state->getId(),
            'lesson_id' => $this->state->getLessonId(),
            'order' => $this->state->getOrder(),
            'price' => $this->state->getPrice(),
            'widgets' => array()
        );
        
        $widgetIds = $this->state->getWidgetIds();
        $widgetTypeIds = $this->state->getWidgetTypeIds();
        
        foreach ($widgetIds as $index => $widgetId) {
            $widget = $this->getWidget($widgetTypeIds[$index], $widgetId);
            $widget instanceof Domain_CanBeShown;
            $widgetData = $widget->show();
            $widgetData['widget_type'] = $this->widgetTypes[$widgetTypeIds[$index]];
            $data['widgets'][] = $widgetData;
        }

        return $data;
        
    }
    
    public function addText($textString) {

        $text = $this->textCollection->create($textString);
        $this->textCollection->update($text);
        
        $widgetIds = $this->state->getWidgetIds();
        $widgetTypeIds = $this->state->getWidgetTypeIds();

        $widgetIds[] = $text->getId();
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
<?php
/**
 * Показ части урока
 */
class Domain_Message_Item_PartPresentation 
implements
    Domain_Message_Item_PresentingInterface
{
    
    /**
     * ID части урока
     * @var integer
     */
    private $partId;
    
    /**
     * Показы учебных пособий
     * @var array
     */
    private $widgetPresentations;
    
    /**
     * Создаёт экземпляр класса
     * @param integer $partId ID части урока
     * @param array $widgetPresentations показы учебных пособий
     */
    public function __construct(
        $partId,
        array $widgetPresentations
    ) {
        
        $this->partId = $partId;
        $this->widgetPresentations = $widgetPresentations;
        
    }
    
    /**
     * Преобразует в массив
     * @return array
     */
    public function toArray() {
        
        $widgets = array();
        foreach ($this->widgetPresentations as $widgetPresentation) {
            
            $widgetPresentation instanceof Domain_Message_Item_PresentingInterface;
            $widget = $widgetPresentation->toArray();
            $this->checkWidgetArray($widget);
            $widgets[] = $widget;
            
        }
        
        return array(
            'part_id' => $this->partId,
            'widgets' => $widgets
        );
        
    }
    
    private function checkWidgetArray(array $widget) {
        
        if (!array_key_exists('widget_type', $widget)) {
            throw new Domain_Message_Item_Exception('Не указан тип показываемого учебного пособия.');
        }
        
    }

    
}
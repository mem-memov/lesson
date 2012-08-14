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
     * Номер по порядку
     * @var integer
     */
    private $order;
    
    /**
     * Цена данной части урока
     * @var integer
     */
    private $price;
    
    /**
     * Показы учебных пособий
     * @var array
     */
    private $widgetPresentations;
    
    /**
     * Названия типов учебных пособий
     * @var string[]
     */
    private $widgetTypes;
    
    /**
     * Создаёт экземпляр класса
     * @param integer $partId ID части урока
     * @param integer $order номер по порядку
     * @param integer $price цена данной части урока
     * @param array $widgetPresentations показы учебных пособий
     * @param array $widgetTypes нзвания типов учебных пособий
     */
    public function __construct(
        $partId,
        $order,
        $price,
        array $widgetPresentations,
        array $widgetTypes
    ) {
        
        $this->partId = $partId;
        $this->order = $order;
        $this->price = $price;
        $this->widgetPresentations = $widgetPresentations;
        $this->widgetTypes = $widgetTypes;
        
    }
    
    /**
     * Преобразует в массив
     * @return array
     */
    public function toArray() {
        
        $widgets = array();
        foreach ($this->widgetPresentations as $index => $widgetPresentation) {
            
            $widgetPresentation instanceof Domain_Message_Item_PresentingInterface;
            $widget = $widgetPresentation->toArray();
            $widget['widget_type'] = $this->widgetTypes[$index];
            $widgets[] = $widget;
            
        }
        
        return array(
            'part_id' => $this->partId,
            'order' => $this->order,
            'price' => $this->price,
            'widgets' => $widgets
        );
        
    }

}
<?php
/**
 * Почтовый адрес
 */
class Domain_Email
implements
    Domain_CanBePresented
{
    
    /**
     * Состояние
     * @var Data_State_Item_Email
     */
    private $state;
    
    public function __construct(
        Data_State_Item_Email $state
    ) {
        
        $this->state = $state;
      
    }
    
    public function bePresented() {
        
        $parts = $this->partCollection->readUsingLessonId( $this->state->getId() );
        
        $partInspector = $this->partInspectorFactory->makeMessage();
        
        foreach ($parts as $part) {
            $part->beInspected($partInspector);
        }
        
        return $this->presentationFactory->makeMessage(
            $this->state->getId(), 
            $this->state->getTitle(), 
            $this->state->getDescription(),
            $partInspector->getPartIds(),
            $partInspector->getTotalPrice()
        );
        
    }

}

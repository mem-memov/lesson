<?php
class Domain_Text 
implements
    Domain_CanBePresented
{
    
    private $state;
    
    /**
     * Фабрика показов
     * @var Domain_Message_Factory_TextPresentation 
     */
    private  $presentationFactory;
    
    public function __construct(
        Data_State_Item_Text $state,
        Domain_Message_Factory_TextPresentation $presentationFactory
    ) {
        
        $this->state = $state;
        $this->presentationFactory = $presentationFactory;
        
    }
    
    public function bePresented() {
        
        return $this->presentationFactory->makeMessage(
            $this->state->getId(),
            $this->state->getText()
        );
        
    }
    
    public function joinPart(
        Domain_Message_Text_Request_PartJoinCall $joinCall
    ) {
        
        $joinCall->addWidgetId( $this->state->getId() );
        
    }
    
}
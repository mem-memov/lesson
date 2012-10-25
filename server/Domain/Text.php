<?php
class Domain_Text 
implements
    Domain_CanBePresented
{
    
    private $state;
    
    /**
     * Фабрика сообщений
     * @var Domain_Message_Text_Factory 
     */
    private $messageFactory;
    
    public function __construct(
        Data_State_Item_Text $state,
        Domain_Message_Text_Factory $messageFactory
    ) {
        
        $this->state = $state;
        $this->messageFactory = $messageFactory;
        
    }
    
    public function bePresented() {
        
        return $this->messageFactory->makeTextPresentation(
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
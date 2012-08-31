<?php
class Domain_Account 
implements
    Domain_CanBePresented
{
    
    private $state;
    
    /**
     * Фабрика сообщений
     * @var Domain_Message_Account_Factory 
     */
    private $messageFactory;
    
    public function __construct(
        Data_State_Item_Account $state,
        Domain_Message_Account_Factory $messageFactory
    ) {
        
        $this->state = $state;
        $this->messageFactory = $messageFactory;
        
    }
    
    public function bePresented() {
        
        $presentation = $this->messageFactory->makeAccountPresentation( $this->state->getAmount() );
        return $presentation;
        
    }
    
    public function increase($amount) {
        $this->state->setAmount( $this->state->getAmount() + $amount );
    }
    
    public function decrease($amount) {
        
        if (!$this->canDecrease($amount)) {
            throw new Domain_Exception_NotEnoughMoney();
        }
        
        $this->state->setAmount( $this->state->getAmount() - $amount );
        
    }
    
    private function canDecrease($amount) {
        return ( $this->state->getAmount() - $amount ) >= 0;
    }
    
}

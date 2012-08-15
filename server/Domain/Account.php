<?php
class Domain_Account 
implements
    Domain_CanBePresented
{
    
    private $state;
    
    /**
     * Фабрика показов счетов
     * @var Domain_Message_Factory_AccountPresentation 
     */
    private $presentationFactory;
    
    public function __construct(
        Data_State_Item_Account $state,
        Domain_Message_Factory_AccountPresentation $presentationFactory
    ) {
        
        $this->state = $state;
        $this->presentationFactory = $presentationFactory;
        
    }
    
    public function bePresented() {
        
        $presentation = $this->presentationFactory->makeMessage( $this->state->getAmount() );
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

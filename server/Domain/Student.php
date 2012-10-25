<?php
class Domain_Student {
    
    private $state;
    
    /**
     * Фабрика сообщений
     * @var Domain_Message_Student_Factory 
     */
    private $messageFactory;
    
    /**
     * Коллекция счетов
     * @var Domain_Collection_Account 
     */
    private $accountCollection;

    
    public function __construct(
        Data_State_Item_Student $state,
        Domain_Message_Student_Factory $messageFactory,
        Domain_Collection_Account $accountCollection
    ) {
        
        $this->state = $state;
        $this->messageFactory = $messageFactory;
        $this->accountCollection = $accountCollection;
        
    }
    
    
    public function learn(Domain_Message_Student_Request_LearnRequest $learnRequest) {
        
        $part = $learnRequest->getPart();
        $account = $this->accountCollection->readUsingUserId( $this->state->getId() );
        
        $partPaymentRequest = $this->messageFactory->makePartPaymentRequest(
            $account,
            $this->accountCollection
        );
        $part->bePaidFor($partPaymentRequest);
        
    }
    
    public function deposit($amount = null) { //TODO: создать сообщение для этого случая
        
        $account = $this->accountCollection->readUsingUserId( $this->state->getId() );
        
        if (!is_null($amount)) {
            $account->increase($amount);
            $this->accountCollection->update($account);
        }
        
        $accountPresentation = $account->bePresented();
        
        return $accountPresentation;
        
    }
    
}

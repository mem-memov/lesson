<?php
class Domain_Student {
    
    private $state;
    
    /**
     * Коллекция счетов
     * @var Domain_Collection_Account 
     */
    private $accountCollection;
    
    /**
     * Фабрика запросов на оплату части урока
     * @var Domain_Message_Factory_PartPaymentRequest 
     */
    private $partPaymentRequestFactory;
    
    public function __construct(
        Data_State_Item_Student $state,
        Domain_Collection_Account $accountCollection,
        Domain_Message_Factory_PartPaymentRequest $partPaymentRequestFactory
    ) {
        
        $this->state = $state;
        $this->accountCollection = $accountCollection;
        $this->partPaymentRequestFactory = $partPaymentRequestFactory;
        
    }
    
    
    public function learn(Domain_Message_Item_LearnRequest $learnRequest) {
        
        $part = $learnRequest->getPart();
        $account = $this->accountCollection->readUsingUserId( $this->state->getId() );
        
        $partPaymentRequest = $this->partPaymentRequestFactory->makeMessage(
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

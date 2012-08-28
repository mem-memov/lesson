<?php
class Domain_User {

    /**
     * Сосояние
     * @var Data_State_Item_User 
     */
    private $state;

    /**
     * Коллекция почтовых адресов
     * @var Domain_Collection_Email 
     */
    private $emailCollection;
    
    /**
     * Фабрика инспекторов почтовых адресов
     * @var Domain_Message_Factory_EmailInspector
     */
    private $emailInspectorFactory;

    /**
     * Фабрика запросов на перемещение почтового сообщения
     * @var Domain_Message_Factory_MailRequest
     */
    private $mailRequestFactory;
    
    public function __construct(
        Data_State_Item_User $state,
        Domain_Collection_Email $emailCollection,
        Domain_Message_Factory_EmailInspector $emailInspectorFactory,
        Domain_Message_Factory_MailRequest $mailRequestFactory
    ) {
        
        $this->state = $state;
        $this->emailCollection = $emailCollection;
        $this->emailInspectorFactory = $emailInspectorFactory;
        $this->mailRequestFactory = $mailRequestFactory;
        
    }

    public function acquireMailBox($emailAddress) {
        
        $email = $this->emailCollection->create( $this->state->getId(), $emailAddress );
        
        $this->emailCollection->update( $email );

    }
    
    public function receiveMail(
        Domain_Message_Item_MailReceptionRequest $mailReceptionRequest
    ) {
        
        $emails = $this->emailCollection->readUsingUserId( $this->state->getId() );
        
        $emailInspector = $this->emailInspectorFactory->makeMessage();
        
        $mailRequest = $this->mailRequestFactory->makeMessage(
            $mailReceptionRequest->getLetterTemplateName(), 
            $mailReceptionRequest->getData()
        );
        
        foreach ($emails as $email) {
            $email instanceof Domain_Email;
            $email->beInspected($emailInspector);
            $email->exceptMessage($mailRequest);
        }
        
    }

}

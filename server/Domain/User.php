<?php
class Domain_User {

    /**
     * Сосояние
     * @var Data_State_Item_User 
     */
    private $state;
    
    /**
     * Фабрика сообщений
     * @var Domain_Message_User_Factory 
     */
    private $messageFactory;

    /**
     * Коллекция почтовых адресов
     * @var Domain_Collection_Email 
     */
    private $emailCollection;
    
    /**
     * Фабрика помошников активации адреса электронной почты
     * @var Domain_Collaborator_Factory_EmailActivation
     */
    private $emailActivationFactory;
    
    
    public function __construct(
        Data_State_Item_User $state,
        Domain_Message_User_Factory $messageFactory,
        Domain_Collection_Email $emailCollection,
        Domain_Collaborator_Factory_EmailActivation $emailActivationFactory
    ) {
        
        $this->state = $state;
        $this->messageFactory = $messageFactory;
        $this->emailCollection = $emailCollection;
        $this->emailActivationFactory = $emailActivationFactory;
        
    }

    public function acquireMailBox($emailAddress) {
        
        $email = $this->emailCollection->create( $this->state->getId(), $emailAddress );
        
        $this->emailCollection->update( $email );

    }
    
    public function receiveMail(
        Domain_Message_User_Request_MailReceptionRequest $mailReceptionRequest
    ) {
        
        $emails = $this->emailCollection->readUsingUserId( $this->state->getId() );
        
        $emailInspector = $this->messageFactory->makeEmailInspector();
        
        $mailData = $mailReceptionRequest->getData();
        $mailData['user_id'] = $this->state->getId();
        
        $mailRequest = $this->messageFactory->makeMailRequest(
            $mailReceptionRequest->getLetterTemplateName(), 
            $mailData
        );
        
        foreach ($emails as $email) {
            $email instanceof Domain_Email;
            $email->beInspected($emailInspector);
            $email->exceptMessage($mailRequest);
        }
        
    }
    
    public function confirmEmail( 
        Domain_Message_User_Request_EmailConfirmationRequest $emailConfirmationRequest
    ) {
        
        $email = $this->emailCollection->readUsingEmail( $emailConfirmationRequest->getEmail() );
        
        if (is_null($email)) {
            $emailConfirmationReport = $this->messageFactory->makeEmailConfirmationReport(array(
                new Domain_Exception_UserIsNotEmailOwner()
            ));
            return $emailConfirmationReport;
        }
            
        $email->beConfirmed();
        $this->emailCollection->update($email);
        
        $emailConfirmationReport = $this->messageFactory->makeEmailConfirmationReport();
        return $emailConfirmationReport;
        
    }
    
    public function composeEmailActivationKey($email) {
        
        $emailActivationCollaborator = $this->emailActivationFactory->make(
            $this->state->getId(), 
            $email
        );
        
        return $emailActivationCollaborator->composeEmailActivationKey();
        
    }

}

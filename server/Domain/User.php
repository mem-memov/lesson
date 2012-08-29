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
     * Фабрика помошников активации адреса электронной почты
     * @var Domain_Collaborator_Factory_EmailActivation
     */
    private $emailActivationFactory;
    
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
    
    /**
     * Фабрика отчётов о подтверждении владения адресом электронной почты
     * @var Domain_Message_Factory_EmailConfirmationReport
     */
    private $emailConfirmationReportFactory;
    
    public function __construct(
        Data_State_Item_User $state,
        Domain_Collection_Email $emailCollection,
        Domain_Collaborator_Factory_EmailActivation $emailActivationFactory,
        Domain_Message_Factory_EmailInspector $emailInspectorFactory,
        Domain_Message_Factory_MailRequest $mailRequestFactory,
        Domain_Message_Factory_EmailConfirmationReport $emailConfirmationReportFactory
    ) {
        
        $this->state = $state;
        $this->emailCollection = $emailCollection;
        $this->emailActivationFactory = $emailActivationFactory;
        $this->emailInspectorFactory = $emailInspectorFactory;
        $this->mailRequestFactory = $mailRequestFactory;
        $this->emailConfirmationReportFactory = $emailConfirmationReportFactory;
        
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
        
        $mailData = $mailReceptionRequest->getData();
        $mailData['user_id'] = $this->state->getId();
        
        $mailRequest = $this->mailRequestFactory->makeMessage(
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
        Domain_Message_Item_EmailConfirmationRequest $emailConfirmationRequest
    ) {
        
        $email = $this->emailCollection->readUsingEmail( $emailConfirmationRequest->getEmail() );
        
        if (is_null($email)) {
            $emailConfirmationReport = $this->emailConfirmationReportFactory->makeMessage(array(
                new Domain_Exception_UserIsNotEmailOwner()
            ));
            return $emailConfirmationReport;
        }
            
        $email->beConfirmed();
        $this->emailCollection->update($email);
        
        $emailConfirmationReport = $this->emailConfirmationReportFactory->makeMessage();
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

<?php
class Domain_Guard {
    
    /**
     * Авторизация
     * @var Service_Authentication_Interface
     */
    private $authentication;
    
    /**
     * Фабрика сообщений
     * @var Domain_Message_Guard_Factory 
     */
    private $messageFactory;
    
    /**
     * Коллекция пользователей
     * @var Domain_Collection_User
     */
    private $userCollection;
    
    /**
     * Фабрика помошников активации адреса электронной почты
     * @var Domain_Collaborator_Factory_EmailActivation
     */
    private $emailActivationFactory;
    

    
    public function __construct(
        Service_Authentication_Interface $authentication,
        Domain_Message_Guard_Factory $messageFactory,
        Domain_Collection_User $userCollection,
        Domain_Collaborator_Factory_EmailActivation $emailActivationFactory
    ) {
        
        $this->authentication = $authentication;
        $this->messageFactory = $messageFactory;
        $this->userCollection = $userCollection;
        $this->emailActivationFactory = $emailActivationFactory;
        
    }
    
    public function recognizeByTwitter() {
        
        $this->authentication->useTwitter();
        
    }
    
    public function enroll($email, $password) {
        
        $existingUser = $this->userCollection->readUsingEmail($email);
        
        if (!is_null($existingUser)) {
            $enrollmentReport = $this->messageFactory->makeEnrollmentReport(
                $emailIsOccupied = true
            );
            return $enrollmentReport;
        }

        $user = $this->userCollection->create();

        $this->userCollection->update($user);

        $user->acquireMailBox($email);
        
        $mailReceptionRequest = $this->messageFactory->makeMailReceptionRequest(
            'signup/confirm_email', 
            array(
                'email' => $email,
                'user_id' => 'will be provided by the user object',
                'encoded_email' => urlencode($email),
                'activation_key' => $user->composeEmailActivationKey($email)
            )
        );
        
        $user->receiveMail($mailReceptionRequest);
        
        $enrollmentReport = $this->messageFactory->makeEnrollmentReport(
            $emailIsOccupied = false
        );
        return $enrollmentReport;
        
    }
    
    public function activateEmail($userId, $email, $activationKey) {
        
        $emailActivationCollaborator = $this->emailActivationFactory->make($userId, $email);

        if ( $emailActivationCollaborator->checkEmailActivationKey($activationKey) ) {
            
            $user = $this->userCollection->readUsingId($userId);
            $emailConfirmationRequest = $this->messageFactory->makeEmailConfirmationRequest($email);
            $emailConfirmationReport = $user->confirmEmail($emailConfirmationRequest);
            $emailActivationReport = $this->messageFactory->makeEmailActivationReport(
                $emailConfirmationReport->getProblems()
            );
            return $emailActivationReport;

        }
        
        $emailActivationReport = $this->messageFactory->makeEmailActivationReport(
            new Domain_Exception_EmailActivationKeyDoesNotMatch()
        );
        return $emailActivationReport;
        
    }
    
}
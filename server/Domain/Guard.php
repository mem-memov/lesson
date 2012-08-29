<?php
class Domain_Guard {
    
    /**
     * Авторизация
     * @var Service_Authentication_Interface
     */
    private $authentication;
    
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
    
    /**
     * Фабрика запросов на получение почты
     * @var Domain_Message_Factory_MailReceptionRequest
     */
    private $mailReceptionRequestFactory;
    
    /**
     * Фабрика отчётов о начале регистрации пользователя
     * @var Domain_Message_Factory_EnrollmentReport
     */
    private $enrollmentReportFactory;
    
    /**
     * Фабрика запросов подтвердить адрес электронной почты
     * @var Domain_Message_Factory_EmailConfirmationRequest
     */
    private $emailConfirmationRequestFactory;
    
    /**
     * Фабрика отчётов об активации адреса электронной почты
     * @var Domain_Message_Factory_EmailActivationReport
     */
    private $emailActivationReportFactory;
    
    public function __construct(
        Service_Authentication_Interface $authentication,
        Domain_Collection_User $userCollection,
        Domain_Collaborator_Factory_EmailActivation $emailActivationFactory,
        Domain_Message_Factory_MailReceptionRequest $mailReceptionRequestFactory,
        Domain_Message_Factory_EnrollmentReport $enrollmentReportFactory,
        Domain_Message_Factory_EmailConfirmationRequest $emailConfirmationRequestFactory,
        Domain_Message_Factory_EmailActivationReport $emailActivationReportFactory
    ) {
        
        $this->authentication = $authentication;
        $this->userCollection = $userCollection;
        $this->emailActivationFactory = $emailActivationFactory;
        $this->mailReceptionRequestFactory = $mailReceptionRequestFactory;
        $this->enrollmentReportFactory = $enrollmentReportFactory;
        $this->emailConfirmationRequestFactory = $emailConfirmationRequestFactory;
        $this->emailActivationReportFactory = $emailActivationReportFactory;
        
    }
    
    public function recognizeByTwitter() {
        
        $this->authentication->useTwitter();
        
    }
    
    public function enroll($email, $password) {
        
        $existingUser = $this->userCollection->readUsingEmail($email);
        
        if (!is_null($existingUser)) {
            $enrollmentReport = $this->enrollmentReportFactory->makeMessage(
                $emailIsOccupied = true
            );
            return $enrollmentReport;
        }

        $user = $this->userCollection->create();

        $this->userCollection->update($user);

        $user->acquireMailBox($email);
        
        $mailReceptionRequest = $this->mailReceptionRequestFactory->makeMessage(
            'signup/confirm_email', 
            array(
                'email' => $email,
                'user_id' => 'will be provided by the user object',
                'encoded_email' => urlencode($email),
                'activation_key' => $user->composeEmailActivationKey($email)
            )
        );
        
        $user->receiveMail($mailReceptionRequest);
        
        $enrollmentReport = $this->enrollmentReportFactory->makeMessage(
            $emailIsOccupied = false
        );
        return $enrollmentReport;
        
    }
    
    public function activateEmail($userId, $email, $activationKey) {
        
        $emailActivationCollaborator = $this->emailActivationFactory->make($userId, $email);

        if ( $emailActivationCollaborator->checkEmailActivationKey($activationKey) ) {
            
            $user = $this->userCollection->readUsingId($userId);
            $emailConfirmationRequest = $this->emailConfirmationRequestFactory->makeMessage($email);
            $emailConfirmationReport = $user->confirmEmail($emailConfirmationRequest);
            $emailActivationReport = $this->emailActivationReportFactory->makeMessage(
                $emailConfirmationReport->getProblems()
            );
            return $emailActivationReport;

        }
        
        $emailActivationReport = $this->emailActivationReportFactory->makeMessage(
            new Domain_Exception_EmailActivationKeyDoesNotMatch()
        );
        return $emailActivationReport;
        
    }
    
}
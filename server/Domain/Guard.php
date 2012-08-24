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
     * Фабрика запросов на получение почты
     * @var Domain_Message_Factory_MailReceptionRequest
     */
    private $mailReceptionRequestFactory;
    
    public function __construct(
        Service_Authentication_Interface $authentication,
        Domain_Collection_User $userCollection,
        Domain_Message_Factory_MailReceptionRequest $mailReceptionRequestFactory
    ) {
        
        $this->authentication = $authentication;
        $this->userCollection = $userCollection;
        $this->mailReceptionRequestFactory = $mailReceptionRequestFactory;
        
    }
    
    public function recognizeByTwitter() {
        
        $this->authentication->useTwitter();
        
    }
    
    public function enroll($email, $password) {
        
        $existingUser = $this->userCollection->readUsingEmail($email);
        
        if (!is_null($existingUser)) {
            
        }

        $user = $this->userCollection->create();

        $this->userCollection->update($user);

        $user->acquireMailBox($email);
        
        $mailReceptionRequest = $this->mailReceptionRequestFactory->makeMessage(
            'signup/confirm_email', 
            array(
                'email' => $email
            )
        );
        
        $user->receiveMail($mailReceptionRequest);
        
    }
    
}
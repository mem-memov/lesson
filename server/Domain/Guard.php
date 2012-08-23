<?php
class Domain_Guard {
    
    /**
     * Авторизация
     * @var Service_Authentication_Interface
     */
    private $authentication;
    
    /**
     * Почтовый рассыльщик
     * @var Service_Mailer_Interface
     */
    private $mailer;
    
    /**
     * Коллекция пользователей
     * @var Domain_Collection_User
     */
    private $userCollection;
    
    public function __construct(
        Service_Authentication_Interface $authentication,
        Service_Mailer_Interface $mailer,
        Domain_Collection_User $userCollection
    ) {
        
        $this->authentication = $authentication;
        $this->mailer = $mailer;
        $this->userCollection = $userCollection;
        
    }
    
    public function recognizeByTwitter() {
        
        $this->authentication->useTwitter();
        
    }
    
    public function enroll($email, $password) {
        
        $existingUser = $this->userCollection->readUsingEmail($email);
        
        $user = $this->userCollection->create();
        $this->userCollection->update($user);
        $user->acquireMailBox($email);
        
    }
    
}
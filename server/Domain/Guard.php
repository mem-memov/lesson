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
    
    public function __construct(
        Service_Authentication_Interface $authentication,
        Domain_Collection_User $userCollection
    ) {
        
        $this->authentication = $authentication;
        $this->userCollection = $userCollection;
        
    }
    
    public function recognizeByTwitter() {
        
        $this->authentication->useTwitter();
        
    }
    
}
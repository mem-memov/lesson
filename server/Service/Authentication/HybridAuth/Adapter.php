<?php
class Service_Authentication_HybridAuth_Adapter 
implements
    Service_Authentication_Interface
{
    
    /**
     *
     * @var Hybrid_Auth
     */
    private $hybridAuth;
    
    public function __construct(
        Hybrid_Auth $hybridAuth
    ) {
        
        $this->hybridAuth = $hybridAuth;
        
    }
    
    public function useTwitter() {

        $twitter = $this->hybridAuth->authenticate( 'Twitter' );
        
        $userProfile = $twitter->getUserProfile();
        
        var_dump($userProfile);
        
    }
    
    
}
<?php
class Domain_Collaborator_Item_EmailActivation {
    
    private $userId;
    
    private $email;
    
    public function __construct($userId, $email) {
        
        $this->userId = $userId;
        $this->email = $email;
        
    }
    
    public function checkEmailActivationKey($activationKey) {
        
        $correctKey = $this->composeEmailActivationKey();
        
        return ( $activationKey == $correctKey );
        
    }
    
    public function composeEmailActivationKey() {
        
        return md5($this->userId . $this->email . 'fdgFSGfbdfDFHq4543SG@@d_76');
        
    }
    
}

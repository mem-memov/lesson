<?php
class Frontend_Action_SignOut extends Frontend_Action_Abstract {
    
    public function run() {

        $this->request->redirectSignedOutUser();
        
        
    }
    
}
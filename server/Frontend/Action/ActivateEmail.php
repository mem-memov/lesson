<?php
class Frontend_Action_ActivateEmail extends Frontend_Action_Abstract {
    
    public function run() {

        if (
                    !$this->request->hasDirectory(2) 
                ||  !$this->request->hasDirectory(3) 
                ||  !$this->request->hasDirectory(4) 
        ) {
            return $this->chain->linkPageNotFound()->run();
        }
        
        $userId = $this->request->getDirectory(2);
        $email = urldecode( $this->request->getDirectory(3) );
        $activationKey = $this->request->getDirectory(4);
        
        
        return $this->reportActivationResult($userId, $email, $activationKey);

    }
    
    private function reportActivationResult($userId, $email, $activationKey) {
        
        $guard = $this->domainFactory->makeGuard();

        $emailActivationReport = $guard->activateEmail($userId, $email, $activationKey);
        
        if ( !$emailActivationReport->hasProblems() ) {
            return $this->reportSuccess($email);
        } else {
            return $this->reportFailure($emailActivationReport->getProblems());
        }
        
    }
    
    private function reportSuccess($email) {
        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/ActivateEmail/success.php',
            array(
                'email' => $email
            ),
            array(),
            array()
        );
        
    }
    
    private function reportFailure(array $problems) {
        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/ActivateEmail/failure.php',
            array(),
            array(),
            array()
        );
        
    }
    
}
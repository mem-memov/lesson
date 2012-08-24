<?php
class Frontend_Action_SignUp extends Frontend_Action_Abstract {
    
    public function run() {

        if (
                $this->request->hasParameter('email') 
            &&  $this->request->hasParameter('password')
        ) {
            
            return $this->signUp(
                $this->request->getParameter('email'),
                $this->request->getParameter('password')
            );

        } else {
            
            return $this->showForm();
            
        }

    }
    
    private function showForm() {
        
        return $this->responseFactory->makeHtmlResponse(
            '/client/Action/SignUp/form.php',
            array(),
            array(),
            array()
        );
        
    }
    
    private function signUp($email, $password) {
        
        $guard = $this->domainFactory->makeGuard();
        
        $guard->enroll($email, $password);
        
        return $this->responseFactory->makeHtmlResponse(
            '/client/Action/SignUp/form.php',
            array(),
            array(),
            array()
        );
        
    }
    
}
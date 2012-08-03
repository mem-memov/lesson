<?php
class Frontend_Action_SignIn extends Frontend_Action_Abstract {
    
    public function run() {

        if (
                $this->request->hasParameter('user') 
            &&  $this->request->hasParameter('password')
        ) {
            return $this->signIn();
        } else {
            return $this->showForm();
        }

    }
    
    private function showForm() {
        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/SignIn/form.php',
            array(
                
            ),
            array(),
            array()
        );
        
    }
    
    private function signIn() {
        
        $user = $this->request->getParameter('user');
        $password = $this->request->getParameter('password');
        $mustRemember = $this->request->hasParameter('rememberme');


        $this->request->redirectSignedUpUser('12', 'dfddgf', $mustRemember);

    }
    
}
<?php
class Frontend_Action_Payment extends Frontend_Action_Abstract {
    
    public function run() {

        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/Payment/form.php',
            array(
                
            ),
            array(),
            array()
        );
        
    }
    
}
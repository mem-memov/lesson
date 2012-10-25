<?php
class Frontend_Action_HybridAuth extends Frontend_Action_Abstract {
    
    public function run() {

        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/HybridAuth/index.php',
            array(
                
            ),
            array(),
            array()
        );
        
    }
    
}
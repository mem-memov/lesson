<?php
class Frontend_Action_PageNotFound extends Frontend_Action_Abstract {
    
    public function run() {

        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/PageNotFound/message.php',
            array(
                
            ),
            array(),
            array()
        );
        
    }
    
}
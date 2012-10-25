<?php
class Frontend_Action_Income extends Frontend_Action_Abstract {
    
    public function run() {

        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/Income/report.php',
            array(
                
            ),
            array(),
            array()
        );
        
    }
    
}
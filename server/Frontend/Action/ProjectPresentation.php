<?php
class Frontend_Action_ProjectPresentation extends Frontend_Action_Abstract {
    
    public function run() {

        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/ProjectPresentation/presentation.php',
            array(
                
            ),
            array(),
            array()
        );
        
    }
    
}
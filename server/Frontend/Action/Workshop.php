<?php
class Frontend_Action_Workshop extends Frontend_Action_Abstract {
    
    public function run() {

        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/Workshop/form.php',
            array(
                
            ),
            array(),
            array()
        );
        
    }
    
}
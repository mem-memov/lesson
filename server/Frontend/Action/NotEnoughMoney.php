<?php
class Frontend_Action_NotEnoughMoney extends Frontend_Action_Abstract {
    
    public function run() {

        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/NotEnoughMoney/message.php',
            array(
                
            ),
            array(),
            array()
        );
        
    }
    
}
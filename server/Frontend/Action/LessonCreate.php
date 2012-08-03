<?php
class Frontend_Action_LessonCreate extends Frontend_Action_Abstract {
    
    public function run() {

        $userId = $this->request->getUserId();
var_dump($userId);        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/LessonCreate/form.php',
            array(
                
            ),
            array(),
            array()
        );
        
    }
    
}
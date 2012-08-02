<?php
class Frontend_Action_LessonList extends Frontend_Action_Abstract {
    
    public function run() {

        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/LessonList/list.php',
            array(
                
            ),
            array(),
            array()
        );
        
    }
    
}
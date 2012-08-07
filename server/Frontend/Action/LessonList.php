<?php
class Frontend_Action_LessonList extends Frontend_Action_Abstract {
    
    public function run() {

        $school = $this->domainFactory->makeSchool();
        
        $filter = array();
        
        $lessonArrays = $school->offerLessons($filter);

        return $this->responseFactory->makeHtmlResponse(
            'client/Action/LessonList/list.php',
            array(
                'lessons' => $lessonArrays
            ),
            array(),
            array()
        );
        
    }
    
}
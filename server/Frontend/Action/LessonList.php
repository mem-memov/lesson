<?php
class Frontend_Action_LessonList extends Frontend_Action_Abstract {
    
    public function run() {

        $school = $this->domainFactory->makeSchool();
        
        $filter = array();
        
        $lessonPresentations = $school->offerLessons($filter);
        
        $lessonArrays = array();
        foreach ($lessonPresentations as $lessonPresentation) {

            $lessonArrays[] = $lessonPresentation->toArray();
            
        }

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
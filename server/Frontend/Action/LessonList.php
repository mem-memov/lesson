<?php
class Frontend_Action_LessonList extends Frontend_Action_Abstract {
    
    public function run() {

        $school = $this->domainFactory->makeSchool();
        
        $filter = array();
        
        $lessons = $school->offerLessons($filter);
        
        $lessonArrays = array();
        foreach ($lessons as $lesson) {
            
            $lesson instanceof Domain_Lesson;
            $lessonArrays[] = $lesson->toArray();
            
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
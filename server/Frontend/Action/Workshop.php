<?php
class Frontend_Action_Workshop extends Frontend_Action_Abstract {
    
    public function run() {

        $teacherId = $this->request->getUserId();
        
        $school = $this->domainFactory->makeSchool();
        
        $filter = array('teacher_id' => $teacherId);
        
        $lessons = $school->offerLessons($filter);

        $lessonTitles = array();
        $lessonIds = array();
        foreach ($lessons as $lesson) {
            
            $lesson instanceof Domain_Lesson;
            $lessonTitles[] = $lesson->getTitle();
            $lessonIds[] = $lesson->getId();
            
        }
        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/Workshop/form.php',
            array(
                'lesson_ids' => $lessonIds,
                'lesson_titles' => $lessonTitles
            ),
            array(),
            array()
        );
        
    }
    
}
<?php
class Frontend_Action_Workshop extends Frontend_Action_Abstract {
    
    public function run() {

        $teacherId = $this->request->getUserId();
        
        $school = $this->domainFactory->makeSchool();
        
        $filter = array('teacher_id' => $teacherId);
        
        $lessonPresentations = $school->offerLessons($filter);

        $lessonTitles = array();
        $lessonIds = array();
        foreach ($lessonPresentations as $lessonPresentation) {
            $lessonArray = $lessonPresentation->toArray();
            $lessonTitles[] = $lessonArray['title'];
            $lessonIds[] = $lessonArray['lesson_id'];
            
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
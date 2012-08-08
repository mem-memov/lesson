<?php
class Frontend_Action_LessonToTeacher extends Frontend_Action_Abstract {
    
    public function run() {

        $teacherId = $this->request->getUserId();
        
        if (!$this->request->hasDirectory(3)) {
            $response = $this->chain->linkPageNotFound()->run();
        } else {
            
            $lessonId = $this->request->getDirectory(3);
            $response = $this->respond($lessonId, $teacherId);
            
        }

        return $response;
        

        
    }
    
    public function respond($lessonId, $teacherId) {
       
        $lessonArray = $this->fetchLessonArray($lessonId, $teacherId);
        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/LesonToTeacher/report.php',
            array(
                'title' => $lessonArray['title'],
                'description' => $lessonArray['description']
            ),
            array(),
            array()
        );
        
    }
    
    public function fetchLessonArray($lessonId, $teacherId) {
        
        $school = $this->domainFactory->makeSchool();
        
        $filter = array('lesson_id' => $lessonId, 'teacher_id' => $teacherId);
        
        $lessonArrays = $school->offerLessons($filter);

        return $lessonArrays[0];
        
    }
    
}
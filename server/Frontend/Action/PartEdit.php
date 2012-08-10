<?php
class Frontend_Action_PartEdit extends Frontend_Action_Abstract {
    
    public function run() {
        
        $teacherId = $this->request->getUserId();
        
        if (!$this->request->hasDirectory(4) || !$this->request->hasDirectory(5)) {
            $response = $this->chain->linkPageNotFound()->run();
        } else {
            
            $lessonId = $this->request->getDirectory(4);
            $partId = $this->request->getDirectory(5);
            $response = $this->respond($teacherId, $lessonId, $partId);
            
        }

        return $response;
        
    }
    
    public function respond($teacherId, $lessonId, $partId) {
        
        $lesson = $this->fetchLesson($teacherId, $lessonId);
        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/PartEdit/form.php',
            array(
                'part_id' => $partId
            ),
            array(),
            array()
        );
        
    }
    
    /**
     * Возвращает урок учителя
     * @param integer $teacherId
     * @param integer $lessonId
     * @return Domain_Lesson
     */
    public function fetchLesson($teacherId, $lessonId) {
        
        $school = $this->domainFactory->makeSchool();
        
        $filter = array('lesson_id' => $lessonId, 'teacher_id' => $teacherId);
        
        $lessons = $school->offerLessons($filter);

        return $lessons[0];
        
    }
    
}
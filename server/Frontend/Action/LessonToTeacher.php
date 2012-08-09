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
       
        $lesson = $this->fetchLesson($lessonId, $teacherId);
        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/LesonToTeacher/report.php',
            array(
                'id' => $lesson->getId(),
                'title' => $lesson->getTitle(),
                'description' => $lesson->getDescription()
            ),
            array(),
            array()
        );
        
    }
    
    /**
     * Возвращает урок учителя
     * @param integer $lessonId
     * @param integer $teacherId
     * @return Domain_Lesson
     */
    public function fetchLesson($lessonId, $teacherId) {
        
        $school = $this->domainFactory->makeSchool();
        
        $filter = array('lesson_id' => $lessonId, 'teacher_id' => $teacherId);
        
        $lessons = $school->offerLessons($filter);

        return $lessons[0];
        
    }
    
}
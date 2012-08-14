<?php
class Frontend_Action_LessonToTeacher extends Frontend_Action_Abstract {
    
    public function run() {

        $teacherId = $this->request->getUserId();
        
        if (!$this->request->hasDirectory(3)) {
            $response = $this->chain->linkPageNotFound()->run();
        } else {
            
            $lessonId = $this->request->getDirectory(3);
            $response = $this->respond($teacherId, $lessonId);
            
        }

        return $response;
        

        
    }
    
    public function respond($teacherId, $lessonId) {
       
        $lessonPresentation = $this->fetchLesson($teacherId, $lessonId);
        $lessonArray = $lessonPresentation->toArray();

        return $this->responseFactory->makeHtmlResponse(
            'client/Action/LesonToTeacher/report.php',
            array(
                'id' => $lessonArray['lesson_id'],
                'title' => $lessonArray['title'],
                'description' => $lessonArray['description'],
                'part_ids' => $lessonArray['part_ids']
            ),
            array(),
            array()
        );
        
    }
    
    /**
     * Возвращает урок учителя
     * @param integer $teacherId
     * @param integer $lessonId
     * @return Domain_Message_Item_Presentation 
     */
    public function fetchLesson($teacherId, $lessonId) {
        
        $school = $this->domainFactory->makeSchool();
        
        $filter = array('lesson_id' => $lessonId, 'teacher_id' => $teacherId);
        
        $lessons = $school->offerLessons($filter);

        return $lessons[0];
        
    }
    
}
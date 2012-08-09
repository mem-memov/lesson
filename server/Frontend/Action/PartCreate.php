<?php
class Frontend_Action_PartCreate extends Frontend_Action_Abstract {
    
    public function run() {
        
        $teacherId = $this->request->getUserId();
        
        $school = $this->domainFactory->makeSchool();
        
        if (!$this->request->hasDirectory(4)) {
            $response = $this->chain->linkPageNotFound()->run();
        } else {
            $lessonId = $this->request->getDirectory(4);
        }
        
        $filter = array('lesson_id' => $lessonId, 'teacher_id' => $teacherId);
        
        $lessons = $school->offerLessons($filter);

        $lesson = $lessons[0];
        
        $lesson instanceof Domain_Lesson;

        $lesson->addPart(0);
        
        $lesson = $school->prepareLesson($teacherId, $lesson);
        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/PartCreate/form.php',
            array(
                'lesson_id' => $lesson->getId()
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
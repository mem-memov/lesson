<?php
class Frontend_Action_PartEdit extends Frontend_Action_Abstract {
    
    public function run() {
        
        $teacherId = $this->request->getUserId();
        
        if (!$this->request->hasDirectory(4) || !$this->request->hasDirectory(5)) {
            $response = $this->chain->linkPageNotFound()->run();
        } else {
            
            $lessonId = $this->request->getDirectory(4);
            $partId = $this->request->getDirectory(5);
            
            $parameters = array();
            if ($this->request->hasParameter('create_text')) {
                $parameters['widget_type'] = 'text';
                $parameters['text'] = $this->request->hasParameter('text') 
                                                        ? $this->request->getParameter('text') 
                                                        : ''
                ;
            }

            $response = $this->respond($teacherId, $lessonId, $partId, $parameters);
            
        }

        return $response;
        
    }
    
    public function respond($teacherId, $lessonId, $partId, $parameters = array()) {

        $lesson = $this->fetchLesson($teacherId, $lessonId);
        
        switch ($parameters['widget_type']) {
            case 'text':
                $lesson->insertText($partId, $parameters['text']);
                break;
        }
        
        $school = $this->domainFactory->makeSchool();
        
        $lesson = $school->prepareLesson($teacherId, $lesson);
        
        $partData = $lesson->showPart($partId);

        return $this->responseFactory->makeHtmlResponse(
            'client/Action/PartEdit/form.php',
            $partData,
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
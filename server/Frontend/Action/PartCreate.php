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

        $lesson = $school->prepareLesson($teacherId, $lessonId);
        
        $lesson instanceof Domain_Lesson;

        $partId = $lesson->addPart(0);
        
        $lesson = $school->prepareLesson($teacherId, $lessonId, $lesson);
        
        return $this->chain->linkPartEdit()->respond($teacherId, $lessonId, $partId);
        
    }
    
}
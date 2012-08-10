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

        $partId = $lesson->addPart(0);
        
        $lesson = $school->prepareLesson($teacherId, $lesson);
        
        return $this->chain->linkPartEdit()->respond($teacherId, $lesson->getId(), $partId);
        
    }
    
}
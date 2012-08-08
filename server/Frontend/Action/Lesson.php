<?php
class Frontend_Action_Lesson extends Frontend_Action_Abstract {
    
    public function run() {

        if (!$this->request->hasDirectory(2)) {
            $response = $this->chain->linkPageNotFound()->run();
        } else {
            switch ($this->request->getDirectory(2)) {
                case 'create':
                    $response = $this->chain->linkLessonCreate()->run();
                    break;
                case 'to-teacher':
                    $response = $this->chain->linkLessonToTeacher()->run();
                    break;
                default:
                    $response = $this->chain->linkPageNotFound()->run();
                    break;
            }
        }
        
        return $response;
        
    }
    
}
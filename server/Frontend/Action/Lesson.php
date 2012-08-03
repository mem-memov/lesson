<?php
class Frontend_Action_Lesson extends Frontend_Action_Abstract {
    
    public function run() {

        if (!$this->request->hasDirectory(2)) {
            $contentResponse = $this->chain->linkPageNotFound();
        } else {
            switch ($this->request->getDirectory(2)) {
                case 'create':
                    $contentResponse = $this->chain->linkLessonCreate();
                    break;
                default:
                    $contentResponse = $this->chain->linkPageNotFound();
                    break;
            }
        }
        
        return $contentResponse;
        
    }
    
}
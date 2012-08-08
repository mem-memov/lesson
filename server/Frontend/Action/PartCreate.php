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
        
        $lessonArray = array(
            'id' => $lessonId,
            'part' => array(
                
            )
        );
        
        $lessonArray = $school->prepareLesson($teacherId, $lessonArray);
        
        return $this->responseFactory->makeHtmlResponse(
            'client/Action/PartCreate/form.php',
            array(
                'lesson_id' => $lessonArray['id']
            ),
            array(),
            array()
        );
    }
    
}
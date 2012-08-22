<?php
class Frontend_Action_LessonShow extends Frontend_Action_Abstract {
    
    public function run() {

        $studentId = $this->request->getUserId();

        if (!$this->request->hasDirectory(3)) {
            return $this->chain->linkPageNotFound()->run();
        } else {
            $lessonId = $this->request->getDirectory(3);
        }
        
        $school = $this->domainFactory->makeSchool();
        $presentation = $school->educate($studentId, $lessonId);

        if ($presentation->hasProblems()) {
            return $this->handleProblems( $presentation->getProblems() );
        }

        if ($presentation->canBeContinued()) {
            
            return $this->responseFactory->makeHtmlResponse(
                'client/Action/LessonShow/part.php',
                $presentation->toArray(),
                array(),
                array()
            );

        } else {
            
            return $this->chain->linkLessonList()->run();
            
        }
        
    }
    
    /**
     * 
     * @param Exception[] $problems
     */
    private function handleProblems(array $problems) {
        
        foreach ($problems as $problem) {
            
            switch ($problem) {
                
                case $problem instanceof Domain_Exception_NotEnoughMoney:
                    return $this->chain->linkNotEnoughMoney()->run();
                    break;
            
            }
            
        }
        
    }
    
}
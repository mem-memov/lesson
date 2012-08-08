<?php
class Frontend_Action_LessonCreate extends Frontend_Action_Abstract {
    
    public function run() {

        $teacherId = $this->request->getUserId();
        
        $school = $this->domainFactory->makeSchool();
        
        $lessonArray = array(
            'title' => $this->request->hasParameter('title') ? $this->request->getParameter('title') : '',
            'description' => $this->request->hasParameter('description') ? $this->request->getParameter('description') : ''
        );
        
        $errorsAreHere = false;
        $errors = array(
            'title_missing' => false
        );

        if (!empty($lessonArray['title'])) {
            $lessonArray = $school->prepareLesson($teacherId, $lessonArray);
        } else {
            $errorsAreHere = true;
            $errors['title_missing'] = true;
        }
       
        if ($errorsAreHere) {
            
            return $this->responseFactory->makeHtmlResponse(
                'client/Action/LessonCreate/form.php',
                array(
                    'title' => $lessonArray['title'],
                    'description' => $lessonArray['description'],
                    'errors' => array(
                        'title_missing' => $errors['title_missing']
                    )
                ),
                array(),
                array()
            );
            
        } else {
            
            return $this->chain->linkLessonToTeacher()->respond($lessonArray['id'], $teacherId);
            
        }

        
    }
    
    
}
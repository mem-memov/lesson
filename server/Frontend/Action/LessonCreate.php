<?php
class Frontend_Action_LessonCreate extends Frontend_Action_Abstract {
    
    public function run() {

        $teacherId = $this->request->getUserId();
        
        $school = $this->domainFactory->makeSchool();
        
        $lessonArray = array(
            'title' => $this->request->hasParameter('title') ? $this->request->getParameter('title') : '',
            'description' => $this->request->hasParameter('description') ? $this->request->getParameter('description') : ''
        );
        
        $errors = array(
            'title_missing' => false
        );

        if (!empty($lessonArray['title'])) {
            $school->prepareLesson($teacherId, $lessonArray);
        } else {
            $errors['title_missing'] = true;
        }
       
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
        
    }
    
}
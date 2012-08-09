<?php
class Frontend_Action_LessonCreate extends Frontend_Action_Abstract {
    
    public function run() {

        $teacherId = $this->request->getUserId();
        
        $school = $this->domainFactory->makeSchool();
        
        $title = $this->request->hasParameter('title') ? $this->request->getParameter('title') : '';
        $description = $this->request->hasParameter('description') ? $this->request->getParameter('description') : '';

        $errorsDetected = false;
        $errors = array(
            'title_missing' => false
        );

        if (
                $this->request->hasParameter('title') // значит была отправлена форма
            &&  !empty($this->request->getParameter('title'))
        ) {
            
            $lesson = $school->prepareLesson($teacherId);
            $lesson->setTitle($title);
            $lesson->setDescription($description);
            $lesson = $school->prepareLesson($teacherId, $lesson);
            
        } else {
            
            $errorsDetected = true;
            $errors['title_missing'] = true;
            
        }
       
        if ($errorsDetected) {
            
            return $this->responseFactory->makeHtmlResponse(
                'client/Action/LessonCreate/form.php',
                array(
                    'title' => $title,
                    'description' => $description,
                    'errors' => array(
                        'title_missing' => $errors['title_missing']
                    )
                ),
                array(),
                array()
            );
            
        } else {
            
            return $this->chain->linkLessonToTeacher()->respond($lesson->getId(), $teacherId);
            
        }

        
    }
    
    
}
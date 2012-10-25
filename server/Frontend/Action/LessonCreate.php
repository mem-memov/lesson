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

        if ($this->request->hasParameter('title')) { // значит была отправлена форма
            
            if ($this->request->getParameter('title') != '') {
                
                $lesson = $school->prepareLesson($teacherId);
                $lesson->setTitle($title);
                $lesson->setDescription($description);
                $lesson = $school->prepareLesson($teacherId, $lesson->getId(), $lesson);
            
            } else {
                
                $errorsDetected = true;
                $errors['title_missing'] = true;
                
            }

        }
       
        if ($errorsDetected) {
            
            // Ошибка в форме
            
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

            if (isset($lesson)) {
                
                // Обработка формы
                
                return $this->chain->linkLessonToTeacher()->respond($teacherId, $lesson->getId());
                
            } else {
                
                // Показ формы
                
                return $this->responseFactory->makeHtmlResponse(
                    'client/Action/LessonCreate/form.php',
                    array(
                        'title' => '',
                        'description' => '',
                        'errors' => array()
                    ),
                    array(),
                    array()
                );
                
            }
            
            
        }

        
    }
    
    
}
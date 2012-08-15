<?php
class Frontend_Action_PartEdit extends Frontend_Action_Abstract {
    
    public function run() {
        
        $teacherId = $this->request->getUserId();
        
        if (!$this->request->hasDirectory(4) || !$this->request->hasDirectory(5)) {
            $response = $this->chain->linkPageNotFound()->run();
        } else {
            
            $lessonId = $this->request->getDirectory(4);
            $partId = $this->request->getDirectory(5);
            
            $parameters = array();
            if ($this->request->hasParameter('create_text')) {
                
                $parameters['command'] = 'create_text';
                $parameters['widget_type'] = 'text';
                $parameters['text'] = $this->request->hasParameter('text') 
                                                        ? $this->request->getParameter('text') 
                                                        : ''
                ;
                
            } elseif ($this->request->hasParameter('change_price')) {
                
                $parameters['command'] = 'change_price';
                $parameters['price'] = $this->request->getParameter('price');
                
            }

            $response = $this->respond($teacherId, $lessonId, $partId, $parameters);
            
        }

        return $response;
        
    }
    
    public function respond($teacherId, $lessonId, $partId, $parameters = array()) {

        $school = $this->domainFactory->makeSchool();
        
        $lesson = $school->prepareLesson($teacherId, $lessonId);

        switch ($parameters['command']) {
            case 'create_text':
                $this->insertText($lesson, $partId, $parameters);
                break;
            case 'change_price':
                $this->setPrice($lesson, $partId, $parameters);
                break;
        }

        $lesson = $school->prepareLesson($teacherId, $lessonId, $lesson);
        
        $partData = $lesson->showPart($partId);
        $partData['lesson_id'] = $lessonId;

        return $this->responseFactory->makeHtmlResponse(
            'client/Action/PartEdit/form.php',
            $partData,
            array(),
            array()
        );
        
    }
    
    private function insertText(
        Domain_Lesson &$lesson, 
        $partId,
        array $parameters
    ) {
        
        switch ($parameters['widget_type']) {
            case 'text':
                $lesson->insertText($partId, $parameters['text']);
                break;
        }
        
    }
    
    private function setPrice(
        Domain_Lesson &$lesson, 
        $partId,
        array $parameters
    ) {
        
        $lesson->setPartPrice($partId, $parameters['price']);
        
    }
    
}
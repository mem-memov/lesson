<?php
class Frontend_Action_Start extends Frontend_Action_Abstract {
    
    public function run() {
        
        $title = 'Ума палата';
        $styles = array(
            '/client/Action/Start/initial.css',
            '/client/Action/Start/menu.css'
        );
        $scripts = array(
            '/client/library/jquery/jquery-1.7.2.js'
        );
        
        
        if (!$this->request->hasDirectory(1)) {
            $contentResponse = $this->chain->linkProjectPresentation();
        } else {
            switch ($this->request->getDirectory(1)) {
                case 'learn':
                    $contentResponse = $this->chain->linkLessonList();
                    break;
                case 'pay':
                    $contentResponse = $this->chain->linkPayment();
                    break;
                case 'teach':
                    $contentResponse = $this->chain->linkWorkshop();
                    break;
                case 'cashout':
                    $contentResponse = $this->chain->linkIncome();
                    break;
                case 'lesson':
                    $contentResponse = $this->chain->linkLesson();
                    break;
                case '!':
                    $contentResponse = $this->chain->linkSignIn();
                    break;
                case 'signout':
                    $contentResponse = $this->chain->linkSignOut();
                    break;
                default:
                    $contentResponse = $this->chain->linkPageNotFound();
                    break;
            }
        }
        $content = $contentResponse->getString();
        
        
        return $this->responseFactory->makeHtmlResponse(
            '/client/Action/Start/mainPage.php',
            array(
                'title' => $title,
                'styles' => $styles,
                'scripts' => $scripts,
                'content' => $content
            ),
            array(),
            array()
        );
        
    }
    
}

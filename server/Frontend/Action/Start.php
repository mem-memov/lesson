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
        
var_dump($this->request);
        if (!$this->request->hasDirectory(1)) {
            $contentResponse = $this->chain->linkProjectPresentation()->run();
        } else {
            switch ($this->request->getDirectory(1)) {
                case 'learn':
                    $contentResponse = $this->chain->linkLessonList()->run();
                    break;
                case 'pay':
                    $contentResponse = $this->chain->linkPayment()->run();
                    break;
                case 'teach':
                    $contentResponse = $this->chain->linkWorkshop()->run();
                    break;
                case 'cashout':
                    $contentResponse = $this->chain->linkIncome()->run();
                    break;
                case 'lesson':
                    $contentResponse = $this->chain->linkLesson()->run();
                    break;
                case '!':
                    $contentResponse = $this->chain->linkSignIn()->run();
                    break;
                case 'signout':
                    $contentResponse = $this->chain->linkSignOut()->run();
                    break;
                case 'hybridauth':
                    $contentResponse = $this->chain->linkHybridAuth()->run();
                    break;
                default:
                    $contentResponse = $this->chain->linkPageNotFound()->run();
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

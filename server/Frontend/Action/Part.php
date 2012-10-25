<?php
class Frontend_Action_Part extends Frontend_Action_Abstract {
    
    public function run() {

        if (!$this->request->hasDirectory(3)) {
            $response = $this->chain->linkPageNotFound()->run();
        } else {
            switch ($this->request->getDirectory(3)) {
                case 'create':
                    $response = $this->chain->linkPartCreate()->run();
                    break;
                case 'edit':
                    $response = $this->chain->linkPartEdit()->run();
                    break;
                default:
                    $response = $this->chain->linkPageNotFound()->run();
                    break;
            }
        }
        
        return $response;
        
    }
    
}
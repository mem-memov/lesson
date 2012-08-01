<?php
class Frontend_Response_Html implements Frontend_Response_Interface {
    
    private $templatePath;
    private $data;
    private $stylePaths;
    private $scriptPaths;
    
    
    
    public function addItem($name, $value) {
        
    }
    
    public function appear() {
        
        echo 'I am an html response';
        
    }
    
}

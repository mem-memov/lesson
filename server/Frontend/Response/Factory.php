<?php
class Frontend_Response_Factory {
    
    public function makeHtmlResponse() {
        
        return new Frontend_Response_Html();
        
    }
    
    public function makeJsonResponse() {
        
        return new Frontend_Response_Json();
        
    }
    
}

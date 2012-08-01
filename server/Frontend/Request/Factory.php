<?php
class Frontend_Request_Factory {
    
    public function makeHtmlRequest() {
        
        return new Frontend_Request_Html();
        
    }
    
    public function makeJsonRequest() {
        
        return new Frontend_Request_Json();
        
    }
    
    
    
}

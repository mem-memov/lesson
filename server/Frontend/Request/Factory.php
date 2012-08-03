<?php
class Frontend_Request_Factory {

    
    public function __construct() {
  
    }
    
    public function makeHtmlRequest(
        array $server,
        array $get,
        array $post,
        array $files,
        array $cookie
    ) {

        return new Frontend_Request_Html(
            $server, 
            $get, 
            $post, 
            $files, 
            $cookie
        );
        
    }
    
    public function makeJsonRequest() {
        
        return new Frontend_Request_Json();
        
    }
    
    
    
}

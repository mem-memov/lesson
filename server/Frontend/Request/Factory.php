<?php
class Frontend_Request_Factory {

    
    public function __construct() {
  
    }
    
    public function makeHtmlRequest(
        Frontend_Input_ServerInterface $server,
        Frontend_Input_KeyValueInterface $get,
        Frontend_Input_KeyValueInterface $post,
        Frontend_Input_FilesInterface $files,
        Frontend_Input_CookieInterface $cookie
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

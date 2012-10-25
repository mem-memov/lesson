<?php
/**
 * Менеджер сведений о сервере
 */
class Frontend_Input_Browser_Server 
implements
    Frontend_Input_ServerInterface
{
    
    public function getRequestUri() {
        
        return $_SERVER['REQUEST_URI'];
        
    }
    
    public function getHttpHost() {
        
        return $_SERVER['HTTP_HOST'];
        
    }
    
}
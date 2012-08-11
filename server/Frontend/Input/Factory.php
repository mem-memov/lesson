<?php
class Frontend_Input_Factory {
    
    private $switch;
    
    public function __construct($switch) {
        
        if (!in_array($switch, array('Browser', 'Test'))) {
            throw new Frontend_Input_Exception('Недопустимый переключатель в абстрактной фабрике - '.$switch);
        }
        
        $this->switch = $switch;
    
    }
    
    /**
     * 
     * @return Frontend_Input_CookieInterface
     */
    public function makeCookie($server, $path = '/') {
        
        $class = 'Frontend_Input_'.$this->switch.'_Cookie';
        
        return new $class($server, $path);
        
    }
    
    /**
     * 
     * @return Frontend_Input_FilesInterface
     */
    public function makeFiles() {
        
        $class = 'Frontend_Input_'.$this->switch.'_Files';
        
        return new $class();
        
    }
    
    /**
     * 
     * @return Frontend_Input_KeyValueInterfaces
     */
    public function makeGet() {
        
        $class = 'Frontend_Input_'.$this->switch.'_Get';
        
        return new $class();
        
    }
    
    /**
     * 
     * @return Frontend_Input_KeyValueInterfaces
     */
    public function makePost() {
        
        $class = 'Frontend_Input_'.$this->switch.'_Post';
        
        return new $class();
        
    }
    
    /**
     * 
     * @return Frontend_Input_ServerInterface
     */
    public function makeServer() {
        
        $class = 'Frontend_Input_'.$this->switch.'_Server';
        
        return new $class();
        
    }
    
}
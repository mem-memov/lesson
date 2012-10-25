<?php
class Frontend_Request_Html implements Frontend_Request_Interface {
    
    private $server;
    private $get;
    private $post;
    private $files;
    private $cookie;
    
    public function __construct(
        Frontend_Input_ServerInterface $server,
        Frontend_Input_KeyValueInterface $get,
        Frontend_Input_KeyValueInterface $post,
        Frontend_Input_FilesInterface $files,
        Frontend_Input_CookieInterface $cookie
    ) {

        $this->server = $server;
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
        $this->cookie = $cookie;
        
        
    }
    
    public function hasDirectory($position) {
        
        $uri = $this->server->getRequestUri();
        $pathArray = explode('/', trim($uri, '/'));

        return array_key_exists($position-1, $pathArray) && $pathArray[$position-1] !== '';
        
    }
    
    public function getDirectory($position) {
        
        if (!$this->hasDirectory($position)) {
            throw new Frontend_Request_Exception('Путь не содержит директорию на позиции '.$position);
        }
        
        $uri = $this->server->getRequestUri();
        $pathArray = explode('/', trim($uri, '/'));
        
        return $pathArray[$position-1];
        
    }
    
    public function getUserId() {

        if (
                !$this->cookie->has('user_id') 
            ||  !$this->cookie->has('secret')
        ) {
            header('Location: /!/'.ltrim($this->server->getRequestUri(), '/'));
        }

        return $this->cookie->get('user_id');
        
    }
    
    public function redirectSignedUpUser($userId, $secret, $mustRemember) {

        if (!$mustRemember) {
            
            /* Set cookie to last 1 year */
            $this->cookie->set('user_id', $userId, 60*60*24*365);
            $this->cookie->set('secret', $secret, 60*60*24*365);
       
        } else {
            /* Cookie expires when browser closes */
            $this->cookie->set('user_id', $userId);
            $this->cookie->set('secret', $secret);
        }
        
        $markPosition = strpos($this->server->getRequestUri(), '!');

        if ($markPosition == 1) {
            header('Location: '.substr($this->server->getRequestUri(), 2));
        }
        
    }
    
    public function redirectSignedOutUser() {
        
        $this->cookie->remove('user_id');
        $this->cookie->remove('secret');
        
        header('Location: /');
        
    }
    
    public function hasParameter($parameter) {

        return $this->post->has($parameter);
        
    }
    
    public function getParameter($parameter) {

        return $this->post->get($parameter);
        
    }

}

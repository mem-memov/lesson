<?php
class Frontend_Request_Html implements Frontend_Request_Interface {
    
    private $server;
    private $get;
    private $post;
    private $files;
    private $cookie;
    
    public function __construct(
        array $server,
        array $get,
        array $post,
        array $files,
        array $cookie
    ) {

        $this->server = $server;
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
        $this->cookie = $cookie;
        
        
    }
    
    public function hasDirectory($position) {
        
        $uri = $this->server['REQUEST_URI'];
        $pathArray = explode('/', trim($uri, '/'));

        return array_key_exists($position-1, $pathArray) && $pathArray[$position-1] !== '';
        
    }
    
    public function getDirectory($position) {
        
        if (!$this->hasDirectory($position)) {
            throw new Frontend_Request_Exception('Путь не содержит директорию на позиции '.$position);
        }
        
        $uri = $this->server['REQUEST_URI'];
        $pathArray = explode('/', trim($uri, '/'));
        
        return $pathArray[$position-1];
        
    }
    
    public function getUserId() {

        if (
                !array_key_exists('user_id', $this->cookie) 
            ||  !array_key_exists('secret', $this->cookie)
        ) {
            header('Location: /!/'.ltrim($this->server['REQUEST_URI'], '/'));
        }

        return $this->cookie['user_id'];
        
    }
    
    public function redirectSignedUpUser($userId, $secret, $mustRemember) {

        if (!$mustRemember) {
            /* Set cookie to last 1 year */
            setcookie('user_id', $userId, time()+60*60*24*365, '/', $this->server['HTTP_HOST']);
            setcookie('secret', $secret, time()+60*60*24*365, '/', $this->server['HTTP_HOST']);
        
        } else {
            /* Cookie expires when browser closes */
            setcookie('user_id', $userId, false, '/', $this->server['HTTP_HOST']);
            setcookie('secret', $secret, false, '/', $this->server['HTTP_HOST']);
        }
        
        $markPosition = strpos($this->server['REQUEST_URI'], '!');

        if ($markPosition == 1) {
            header('Location: '.substr($this->server['REQUEST_URI'], 2));
        }
        
    }
    
    public function redirectSignedOutUser() {
        
        setcookie('user_id', false, false, '/', $this->server['HTTP_HOST']);
        setcookie('secret', false, false, '/', $this->server['HTTP_HOST']);
        
        header('Location: /');
        
    }
    
    public function hasParameter($parameter) {
        
        return array_key_exists($parameter, $this->post);
        
    }
    
    public function getParameter($parameter) {
        
        if (!$this->hasParameter($parameter)) {
            throw new Frontend_Request_Exception('Запрос несуществующего параметра '.$parameter);
        }
        
        return $this->post[$parameter];
        
    }

    private function transformFiles(array $files) {

        $transformed_files = array();

        foreach ($files as $field => $file_data) {

            if (is_array($file_data['name'])) {

                $count = count($file_data['name']);
                $keys = array_keys($file_data);

                for ($i = 0; $i < $count; $i++) {

                    $transformed_files[$i] = array();

                    foreach ($keys as $key) {
                        $transformed_files[$i][$key] = $file_data[$key][$i];
                    }

                }

            }else{

                $transformed_files[] = $files[$field];

            }

        }

        return $transformed_files;

    }
    
}

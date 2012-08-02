<?php
class Frontend_Request_Html implements Frontend_Request_Interface {
    
    private $server;
    private $post;
    private $get;
    private $files;
    private $cookie;
    
    public function __construct(
        array $server,
        array $get,
        array $post,
        array $cookie,
        array $files
    ) {
        
        $this->server = $server;
        $this->get = $get;
        $this->post = $post;
        $this->cookie = $cookie;
        $this->files = $files;
        
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

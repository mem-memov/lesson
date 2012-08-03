<?php
class Frontend_Response_Html implements Frontend_Response_Interface {
    
    private $templatePath;
    private $data;
    private $stylePaths;
    private $scriptPaths;
    
    public function __construct(
        $templatePath,
        array $data,
        array $stylePaths,
        array $scriptPaths
    ) {
        
        $this->templatePath = $templatePath;
        $this->data = $data;
        $this->stylePaths = $stylePaths;
        $this->scriptPaths = $scriptPaths;
        
    }
    
    public function getString() {
        
        $data = $this->data;
        $path = __DIR__.'/../../../'.ltrim($this->templatePath, '/');
   
        return self::fillTemplate($data, $path);
        
    }

    
    public function appear() {

        echo $this->getString();
        
    }
    
    private static function fillTemplate($data, $path) {
        
        ob_start();
        require($path);
        return ob_get_clean();
        
    }
    
}

<?php
class Frontend_Response_Factory {
    
    private $stylePaths;
    private $scriptPaths;
    
    public function __construct() {
        
        $this->stylePaths = array();
        $this->scriptPaths = array();
        
    }
    
    public function makeHtmlResponse(
        $templatePath,
        array $data,
        array $stylePaths,
        array $scriptPaths
    ) {
        
        if (!empty($stylePaths) || !empty($scriptPaths)) {
            
            // накапливаем пути к стилям и скриптам
            $this->stylePaths = array_merge($this->stylePaths, $stylePaths);
            $this->scriptPaths = array_merge($this->scriptPaths, $scriptPaths);

        } else {
            
            // перебрасываем накопленное в шаблон верхнего уровня
            if (isset($data['styles']) && is_array($data['styles'])) {
                $styles = array_unique($this->stylePaths);
                $data['styles'] = array_merge($data['styles'], $styles);
            }
            if (isset($data['scripts']) && is_array($data['scripts'])) {
                $scripts = array_unique($this->scriptPaths);
                $data['scripts'] = array_merge($data['scripts'], $scripts);
            }

        }

        return new Frontend_Response_Html(
                $templatePath,
                $data,
                $this->stylePaths,
                $this->scriptPaths
            );
        
    }
    
    public function makeJsonResponse() {
        
        return new Frontend_Response_Json();
        
    }
    
}

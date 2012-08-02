<?php
class Frontend_Response_Factory {
    
    public function makeHtmlResponse(
        $templatePath,
        array $data,
        array $stylePaths,
        array $scriptPaths
    ) {
        
        return new Frontend_Response_Html(
                $templatePath,
                $data,
                $stylePaths,
                $scriptPaths
            );
        
    }
    
    public function makeJsonResponse() {
        
        return new Frontend_Response_Json();
        
    }
    
}

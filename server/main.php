<?php
/**
 * Точка входа
 */
ini_set('display_errors', true);

header('Content-type: text/html; charset=utf-8');

require_once('Frontend/ClassLoader/Interface.php');
require_once('Frontend/ClassLoader/Php_5_2.php');
require_once('Frontend/Factory.php');

try {

    $frontendFactory = Frontend_Factory::construct(
        require_once('configuration.php'),
        new Frontend_ClassLoader_Php_5_2(
                dirname(__FILE__)
        )
    );
    
    $inputFactory = $frontendFactory->makeInputFactory();
    
    $server = $inputFactory->makeServer();
    $get = $inputFactory->makeGet();
    $post = $inputFactory->makePost();
    $files = $inputFactory->makeFiles();
    $cookie = $inputFactory->makeCookie($server->getHttpHost());
    
    $processor = $frontendFactory->makeProcessor();
    
    $processor->respond(
        $server, 
        $get, 
        $post, 
        $files, 
        $cookie
    );
    
} catch (Exception $e) {
    
    echo $e->getMessage();
    var_dump($e);
    exit();
    
}

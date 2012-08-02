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

    Frontend_Factory::construct(
        require_once('configuration.php'),
        new Frontend_ClassLoader_Php_5_2(
                dirname(__FILE__)
        )
    )->makeProcessor()->respond(
        $_SERVER,
        $_GET,
        $_POST,
        $_FILES,
        $_COOKIE
    );
    
} catch (Exception $e) {
    
    echo $e->getMessage();
    exit();
    
}

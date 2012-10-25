<?php
/**
 * Менеджер сведений о сервере
 */
class Frontend_Input_Test_Server 
implements
    Frontend_Input_ServerInterface,
    Frontend_Input_Test_Interface 
{
    
    /**
     * Параметры тестирования
     * @var array
     */
    private $parameters;
    
    public function __construct() {
        
        $this->parameters = array();
        
    }
    
    public function getRequestUri() {
        
        return $_SERVER['REQUEST_URI'];
        
    }
    
    public function getHttpHost() {
        
        return $_SERVER['HTTP_HOST'];
        
    }
    
    /**
     * Устанавливает тестовые параметры
     * @param array $parameters
     */
    public function setParameters(array $parameters) {
        $this->parameters = $parameters;
    }
    
    /**
     * Возвращает текущие значения параметров
     * @return array
     */
    public function getParameters() {
        return $this->parameters;
    }
    
}
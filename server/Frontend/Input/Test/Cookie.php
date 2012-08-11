<?php
/**
 * Менеджер куков
 */
class Frontend_Input_Test_Cookie 
implements
    Frontend_Input_CookieInterface,
    Frontend_Input_Test_Interface
{

    /**
     * Имя сервера, для которого будут устанавливаться куки
     * @var string 
     */
    private $server;
    
    /**
     * Путь на сервере, для которого будут устанавливаться куки
     * @var string
     */
    private $path;
    
    /**
     * Параметры тестирования
     * @var array
     */
    private $parameters;
    
    public function __construct($server, $path = '/') {
        
        $this->server = $server;
        $this->path = $path;
        
        $this->parameters = array();
        
    }
    
    /**
     * Устанавливает куку
     * @param string $key ключ куки
     * @param string $value значение куки
     * @param integer $time время действия куки в секундах
     */
    public function set($key, $value, $time) {
        
        $this->parameters[$key] = $value;
        
    }
    
    /**
     * Проверяет наличие ключа
     * @param string $key ключ куки
     * @return boolean
     */
    public function has($key) {
        
        return array_key_exists($key, $this->parameters);
        
    }
    
    /**
     * Получает значение куки по ключу
     * @param string $key ключ куки
     * @return string значение куки
     * @throws Frontend_Input_CookieMissingException если ключ не найден
     */
    public function get($key) {
        
        if (!$this->has($key)) {
            throw new Frontend_Input_Exception('Попытка извлечь куку с недействующим ключом - '.$key);
        }
        
        return $this->parameters[$key];
        
    }
    
    /**
     * Удаляет куку
     * @param string $key ключ куки
     */
    public function remove($key) {
        
        if (array_key_exists($key, $this->parameters)) {
            unset($this->parameters[$key]);
        }
        
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
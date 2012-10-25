<?php
/**
 * Менеджер куков
 */
class Frontend_Input_Browser_Cookie 
implements
    Frontend_Input_CookieInterface
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
    
    public function __construct($server, $path = '/') {
        
        $this->server = $server;
        $this->path = $path;
        
    }
    
    /**
     * Устанавливает куку
     * @param string $key ключ куки
     * @param string $value значение куки
     * @param integer $time время действия куки в секундах; если не указано, то до конца сессии браузера
     */
    public function set($key, $value, $time = null) {
        
        if (is_null($time)) {
            
            setcookie($key, $value, false, $this->path, $this->server);
            
        } else {
            
            setcookie($key, $value, time()+$time, $this->path, $this->server);
            
        }

    }
    
    /**
     * Проверяет наличие ключа
     * @param string $key ключ куки
     * @return boolean
     */
    public function has($key) {
        
        return array_key_exists($key, $_COOKIE);
        
    }
    
    /**
     * Получает значение куки по ключу
     * @param string $key ключ куки
     * @return string значение куки
     * @throws Frontend_Input_Exception если ключ не найден
     */
    public function get($key) {
        
        if (!$this->has($key)) {
            throw new Frontend_Input_Exception('Попытка извлечь куку с недействующим ключом - '.$key);
        }
        
        return $_COOKIE[$key];
        
    }
    
    /**
     * Удаляет куку
     * @param string $key ключ куки
     */
    public function remove($key) {
        
        setcookie($key, false, time()-86400, $this->path, $this->server);
        
    }
    
}
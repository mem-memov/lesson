<?php
/**
 * Менеджер данных GET-запроса
 */
class Frontend_Input_Test_Get
implements
    Frontend_Input_KeyValueInterface,
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
    
    /**
     * Проверяет наличие ключа
     * @param string $key ключ
     * @return boolean
     */
    public function has($key) {
        
        return array_key_exists($key, $this->parameters);
        
    }
    
    /**
     * Получает значение по ключу
     * @param string $key ключ
     * @return string значение
     * @throws Frontend_Input_Exception если ключ не найден
     */
    public function get($key) {
        
        if (!$this->has($key)) {
            throw new Frontend_Input_Exception('Попытка извлечь параметр по недействующему - '.$key);
        }
        
        return $this->parameters[$key];
        
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
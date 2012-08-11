<?php
/**
 * Менеджер данных GET-запроса
 */
class Frontend_Input_Browser_Get
implements
    Frontend_Input_KeyValueInterface 
{
    
    /**
     * Проверяет наличие ключа
     * @param string $key ключ
     * @return boolean
     */
    public function has($key) {
        
        return array_key_exists($key, $_GET);
        
    }
    
    /**
     * Получает значение по ключу
     * @param string $key ключ
     * @return string значение
     * @throws Frontend_Input_Exception если ключ не найден
     */
    public function get($key) {
        
        if (!$this->has($key)) {
            throw new Frontend_Input_Exception('Попытка извлечь значение несуществующего поля - '.$key);
        }
        
        return $_GET[$key];
        
    }
    
}
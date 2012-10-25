<?php
/**
 * Интерфейс менеджера ассоциативных массивов
 */
interface Frontend_Input_KeyValueInterface {
    
    /**
     * Проверяет наличие ключа
     * @param string $key ключ
     * @return boolean
     */
    public function has($key);
    
    /**
     * Получает значение по ключу
     * @param string $key ключ
     * @return string значение
     * @throws Frontend_Input_Exception если ключ не найден
     */
    public function get($key);
    
}
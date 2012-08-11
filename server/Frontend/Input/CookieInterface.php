<?php
/**
 * Интерфейс менеджера кук
 */
interface Frontend_Input_CookieInterface {
    
    /**
     * Устанавливает куку
     * @param string $key ключ куки
     * @param string $value значение куки
     * @param integer $time время действия куки в секундах; если не указано, то до конца сессии браузера
     */
    public function set($key, $value, $time = null);
    
    /**
     * Проверяет наличие ключа
     * @param string $key ключ куки
     * @return boolean
     */
    public function has($key);
    
    /**
     * Получает значение куки по ключу
     * @param string $key ключ куки
     * @return string значение куки
     * @throws Frontend_Input_Exception если ключ не найден
     */
    public function get($key);
    
    /**
     * Удаляет куку
     * @param string $key ключ куки
     */
    public function remove($key);
    
}
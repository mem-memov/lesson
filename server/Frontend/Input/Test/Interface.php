<?php
/**
 * Интерфейс для тестирования
 */
class Frontend_Input_Test_Interface {
    
    /**
     * Устанавливает тестовые параметры
     * @param array $parameters
     */
    public function setParameters(array $parameters);
    
    
    /**
     * Возвращает текущие значения параметров
     * @return array
     */
    public function getParameters();
    
}
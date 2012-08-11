<?php
/**
 * Менеджер данных о загруженных файлах
 */
class Frontend_Input_Test_Files
implements
    Frontend_Input_FilesInterface,
    Frontend_Input_Test_Interface  
{
    
    private $parameters;
    
    public function __construct() {
        
        $this->parameters = array(); // [поле][индекс][параметр] = значение
        
    }
    
    /**
     * Проверяет наличие поля формы
     * @param string $key имя поля
     * @param integer $index индекс файла в данном поле
     * @return boolean
     */
    public function has($key, $index = 0) {
        
        return (
                array_key_exists($key, $this->parameters)
                && array_key_exists($index, $this->parameters[$key])
        );
        
    }
    
    /**
     * Возвращает количество файлов, переданных через поле
     * @param string $key имя поля
     * @return integer значение
     * @throws Frontend_Input_Exception если поле не заполнено
     */
    public function count($key) {
        
        $this->checkExistence($key);
                
        return count($this->parameters[$key]);
        
    }
    
    /**
     * Возвращает название файла
     * @param string $key имя поля
     * @param integer $index индекс файла в данном поле
     * @return string значение
     * @throws Frontend_Input_Exception если поле не заполнено
     */
    public function getName($key, $index = 0) {
        
        $this->checkExistence($key);
        
        return $this->parameters[$key][$index]['name'];
        
    }
    
    /**
     * Возвращает тип файла
     * @param string $key имя поля
     * @param integer $index индекс файла в данном поле
     * @return string значение
     * @throws Frontend_Input_Exception если поле не заполнено
     */
    public function getType($key, $index = 0) {
        
        $this->checkExistence($key);
        
        return $this->parameters[$key][$index]['type'];
        
    }
    
    /**
     * Возвращает путь к файлу во временной папке
     * @param string $key имя поля
     * @param integer $index индекс файла в данном поле
     * @return string значение
     * @throws Frontend_Input_Exception если поле не заполнено
     */
    public function getTmpName($key, $index = 0) {
        
        $this->checkExistence($key);
        
        return $this->parameters[$key][$index]['tmp_name'];
        
    }
    
    /**
     * Возвращает код ошибки
     * @param string $key имя поля
     * @param integer $index индекс файла в данном поле
     * @return string значение
     * @throws Frontend_Input_Exception если поле не заполнено
     */
    public function getError($key, $index = 0) {
        
        $this->checkExistence($key);
        
        return $this->parameters[$key][$index]['error'];
        
    }
    
    /**
     * Возвращает размер файла
     * @param string $key имя поля
     * @param integer $index индекс файла в данном поле
     * @return string значение
     * @throws Frontend_Input_Exception если поле не заполнено
     */
    public function getSize($key, $index = 0) {
        
        $this->checkExistence($key);
        
        return $this->parameters[$key][$index]['size'];
        
    }

    /**
     * Устанавливает тестовые параметры
     * @param array $parameters
     */
    public function setParameters(array $parameters) {
        $this->parameters = $parameters; // [поле][индекс][параметр] = значение
    }
    
    /**
     * Возвращает текущие значения параметров
     * @return array
     */
    public function getParameters() {
        return $this->parameters;
    }
    
    private function checkExistence($key, $index = 0) {
        
        if (!$this->has($key, $index)) {
            throw new Frontend_Input_Exception('Попытка извлечь значение несуществующего поля - '.$key);
        }
        
    }
    
}
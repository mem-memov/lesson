<?php
/**
 * Менеджер данных о загруженных файлах
 */
class Frontend_Input_Browser_Files
implements
    Frontend_Input_FilesInterface 
{
    
    private $parameters;
    
    public function __construct() {
        
        // [поле][индекс][параметр] = значение
        $this->parameters = $this->transformFiles($_FILES);
        
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
    
    
    
    
    private function checkExistence($key, $index = 0) {
        
        if (!$this->has($key, $index)) {
            throw new Frontend_Input_Exception('Попытка извлечь значение несуществующего поля - '.$key);
        }
        
    }
    
    /**
     * Преобразует к единообразному виду, независимо от того, сколько файлов загружено
     * @param array $files
     * @return array
     */
    private function transformFiles(array $files) {

        $transformed_files = array();

        foreach ($files as $field => $file_data) {
            
            $transformed_files[$field] = array();

            if (is_array($file_data['name'])) {

                $count = count($file_data['name']);
                $keys = array_keys($file_data);

                for ($i = 0; $i < $count; $i++) {

                    $transformed_files[$field][$i] = array();

                    foreach ($keys as $key) {
                        $transformed_files[$field][$i][$key] = $file_data[$key][$i];
                    }

                }

            }else{

                $transformed_files[$field][0] = $files[$field];

            }

        }

        return $transformed_files;

    }
    
}
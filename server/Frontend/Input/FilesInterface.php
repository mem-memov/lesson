<?php
/**
 * Интерфейс менеджера данных о загруженных файлах
 */
interface Frontend_Input_FilesInterface 
{
    
    /**
     * Проверяет наличие поля формы
     * @param string $key имя поля
     * @param integer $index индекс файла в данном поле
     * @return boolean
     */
    public function has($key, $index = 0);
    
    /**
     * Возвращает количество файлов, переданных через поле
     * @param string $key имя поля
     * @return integer значение
     * @throws Frontend_Input_Exception если поле не заполнено
     */
    public function count($key);
    
    /**
     * Возвращает название файла
     * @param string $key имя поля
     * @param integer $index индекс файла в данном поле
     * @return string значение
     * @throws Frontend_Input_Exception если поле не заполнено
     */
    public function getName($key, $index = 0);
    
    /**
     * Возвращает тип файла
     * @param string $key имя поля
     * @param integer $index индекс файла в данном поле
     * @return string значение
     * @throws Frontend_Input_Exception если поле не заполнено
     */
    public function getType($key, $index = 0);
    
    /**
     * Возвращает путь к файлу во временной папке
     * @param string $key имя поля
     * @param integer $index индекс файла в данном поле
     * @return string значение
     * @throws Frontend_Input_Exception если поле не заполнено
     */
    public function getTmpName($key, $index = 0);
    
    /**
     * Возвращает код ошибки
     * @param string $key имя поля
     * @param integer $index индекс файла в данном поле
     * @return string значение
     * @throws Frontend_Input_Exception если поле не заполнено
     */
    public function getError($key, $index = 0);
    
    /**
     * Возвращает размер файла
     * @param string $key имя поля
     * @param integer $index индекс файла в данном поле
     * @return string значение
     * @throws Frontend_Input_Exception если поле не заполнено
     */
    public function getSize($key, $index = 0);
    
}
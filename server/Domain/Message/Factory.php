<?php
/**
 * Фабрика, которая создаёт фабрики сообщений
 */
class Domain_Message_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;

    /**
     * Создаёт экземпляр класса
     */
    public function __construct() {

        $this->uniqueInstances = array();

    }
    
    /**
     * Создаёт сообщений для части урока
     * @return Domain_Message_Part_Factory
     */
    public function makePartFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Part_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }

    /**
     * Создаёт сообщений для школы
     * @return Domain_Message_School_Factory
     */
    public function makeSchoolFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_School_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }

    /**
     * Создаёт сообщений для ученика
     * @return Domain_Message_Student_Factory
     */
    public function makeStudentFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Student_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }

    /**
     * Создаёт сообщений для учителя
     * @return Domain_Message_Teacher_Factory
     */
    public function makeTeacherFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Teacher_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }

}
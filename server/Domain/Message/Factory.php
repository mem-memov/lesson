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
     * Создаёт фабрику образовательных запросов
     * @return Domain_Message_Factory_EducationRequest 
     */
    public function makeEducationRequestFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Factory_EducationRequest();
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт фабрику презентационных запросов
     * @return Domain_Message_Factory_PresentationRequest 
     */
    public function makePresentationRequestFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Factory_PresentationRequest();
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт фабрику запросов на продолжение урока
     * @return Domain_Message_Factory_ContinueRequest 
     */
    public function makeContinueRequestFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Factory_ContinueRequest();
            
        }

        return $this->instances[$instance_key];
        
    }
    
}
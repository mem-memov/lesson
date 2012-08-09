<?php
/**
 * Фабрика, которая создаёт фабрики состояний
 */
class Data_State_Factory {
    
    /**
     * Контейнер для уникальных объектов
     *
     * @var array
     */
    private $uniqueInstances;

    /**
     * Создаёт экземпляр класса
     *
     * @param array $configuration
     */
    public function __construct() {

        $this->uniqueInstances = array();

    }
    
    /**
     * Создаёт фабрику состояний счетов
     * @return Data_State_AccountFactory 
     */
    public function makeAccountFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Data_State_Factory_Account();
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт фабрику состояний уроков
     * @return Data_State_LessonFactory 
     */
    public function makeLessonFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Data_State_Factory_Lesson();
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт фабрику состояний пользователей
     * @return Data_State_Factory_User
     */
    public function makeUserFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Data_State_Factory_User();
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт фабрику состояний частей урока
     * @return Data_State_Factory_Part
     */
    public function makePartFactory() {
         
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Data_State_Factory_Part();
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт фабрику состояний текстов
     * @return Data_State_Factory_Text
     */
    public function makeTextFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Data_State_Factory_Text();
            
        }

        return $this->instances[$instance_key];
        
    }
    
}

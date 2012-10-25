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
     * Создаёт фабрику сообщений для части урока
     * @return Domain_Message_Account_Factory
     */
    public function makeAccountMessageFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Account_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }

    /**
     * Создаёт фабрику сообщений для почтового адреса
     * @return Domain_Message_Email_Factory
     */
    public function makeEmailMessageFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Email_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }

    /**
     * Создаёт фабрику сообщений для охранника
     * @return Domain_Message_Guard_Factory
     */
    public function makeGuardMessageFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Guard_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }

    /**
     * Создаёт фабрику сообщений для урока
     * @return Domain_Message_Lesson_Factory
     */
    public function makeLessonMessageFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Lesson_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }

    /**
     * Создаёт фабрику сообщений для части урока
     * @return Domain_Message_Part_Factory
     */
    public function makePartMessageFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Part_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }

    /**
     * Создаёт фабрику сообщений для школы
     * @return Domain_Message_School_Factory
     */
    public function makeSchoolMessageFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_School_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }

    /**
     * Создаёт фабрику сообщений для ученика
     * @return Domain_Message_Student_Factory
     */
    public function makeStudentMessageFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Student_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }

    /**
     * Создаёт фабрику сообщений для учителя
     * @return Domain_Message_Teacher_Factory
     */
    public function makeTeacherMessageFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Teacher_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }

    /**
     * Создаёт фабрику сообщений для текстового пособия
     * @return Domain_Message_Text_Factory
     */
    public function makeTextMessageFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Text_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }

    /**
     * Создаёт фабрику сообщений для пользователей
     * @return Domain_Message_User_Factory
     */
    public function makeUserMessageFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_User_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }

    /**
     * Создаёт фабрику сообщений для посещений
     * @return Domain_Message_Visit_Factory
     */
    public function makeVisitMessageFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Visit_Factory();
            
        }

        return $this->instances[$instance_key];
        
    }

}
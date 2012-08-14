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
    
    /**
     * Создаёт фабрику показов текста
     * @return Domain_Message_Factory_TextPresentation 
     */
    public function makeTextPresentationFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Factory_TextPresentation();
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт фабрику показов части урока
     * @return Domain_Message_Factory_PartPresentation 
     */
    public function makePartPresentationFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Factory_PartPresentation();
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт фабрику анонсов части урока
     * @return Domain_Message_Factory_PartPAnnouncement 
     */
    public function makePartAnnouncementFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Factory_PartAnnouncement();
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт фабрику показов урока
     * @return Domain_Message_Factory_LessonPresentation 
     */
    public function makeLessonPresentationFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Factory_LessonPresentation();
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт фабрику показов
     * @return Domain_Message_Factory_Presentation 
     */
    public function makePresentationFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Factory_Presentation();
            
        }

        return $this->instances[$instance_key];
        
    }
    
    /**
     * Создаёт фабрику запросов на посещение урока
     * @return Domain_Message_Factory_VisitRequest 
     */
    public function makeVisitRequestFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Factory_VisitRequest();
            
        }

        return $this->instances[$instance_key];
        
    }

    /**
     * Создаёт фабрику запросов на получение идентификатора части урока
     * @return Domain_Message_Factory_PartIdentificationRequest
     */
    public function makePartIdentificationRequestFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Factory_PartIdentificationRequest();
            
        }

        return $this->instances[$instance_key];
        
    }

    /**
     * Создаёт фабрику инспекторов частей урока
     * @return Domain_Message_Factory_PartInspector
     */
    public function makePartInspectorFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Factory_PartInspector();
            
        }

        return $this->instances[$instance_key];
        
    }

    /**
     * Создаёт фабрику запросов на прикрепление пособия к части урока
     * @return Domain_Message_Factory_PartJoinCall
     */
    public function makePartJoinCallFactory() {
        
        $instance_key = __FUNCTION__;

        if (!isset($this->instances[$instance_key])) {

            $this->instances[$instance_key] = new Domain_Message_Factory_PartJoinCall();
            
        }

        return $this->instances[$instance_key];
        
    }

    

    
}
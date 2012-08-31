<?php
/**
 * Образовательный запрос
 */
class Domain_Message_Teacher_Request_EducationRequest {
    
    /**
     * ID ученика
     * @var integer
     */
    private $studentId;
    
    /**
     * ID урока
     * @var integer
     */
    private $lessonId;
    
    /**
     * Создаёт экземпляр класса
     * @param integer $studentId ID ученика
     * @param integer $lessonId ID урока
     */
    public function __construct($studentId, $lessonId) {
        
        $this->studentId = $studentId;
        $this->lessonId = $lessonId;
        
    }
    
    /**
     * Сообщает ID ученика
     * @return integer
     */
    public function getStudentId() {
        
        return $this->studentId;
        
    }
    
    /**
     * Сообщает ID урока
     * @return integer
     */
    public function getLessonId() {
        
        return $this->lessonId;
        
    }
    
}
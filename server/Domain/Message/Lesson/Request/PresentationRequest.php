<?php
/**
 * Презентационный запрос
 */
class Domain_Message_Lesson_Request_PresentationRequest {
    
    /**
     * ID ученика
     * @var integer
     */
    private $studentId;
    
    /**
     * Учитель
     * @var Domain_Teacher
     */
    private $teacher;
    
    /**
     * Создаёт экземпляр класса
     * @param integer $studentId ID ученика
     * @param Domain_Teacher $teacher учитель
     */
    public function __construct(
        $studentId,
        Domain_Teacher $teacher
    ) {
        
        $this->studentId = $studentId;
        $this->teacher = $teacher;
        
    }
    
    /**
     * Сообщает ID ученика
     * @return integer
     */
    public function getStudentId() {
        
        return $this->studentId;
        
    }
    
    /**
     * Сообщает учителя
     * @return Domain_Teacher
     */
    public function getTeacher() {
        
        return $this->teacher;
        
    }
    
}
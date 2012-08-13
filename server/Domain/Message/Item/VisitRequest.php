<?php
/**
 * Запрос на посещение урока
 */
class Domain_Message_Item_VisitRequest {
    
    /**
     * ID ученика
     * @var integer
     */
    private $studentId;
    
    /**
     * ID учителя
     * @var integer
     */
    private $teacherId;
    
    /**
     * Создаёт экземпляр класса
     * @param integer $studentId ID ученика
     * @param integer $teacherId ID учителя
     */
    public function __construct($studentId, $teacherId) {
        
        $this->studentId = $studentId;
        $this->teacherId = $teacherId;
        
    }
    
    /**
     * Сообщает ID ученика
     * @return integer
     */
    public function getStudentId() {
        
        return $this->studentId;
        
    }
    
    /**
     * Сообщает ID учителя
     * @return integer
     */
    public function getTeacherId() {
        
        return $this->teacherId;
        
    }
    
}
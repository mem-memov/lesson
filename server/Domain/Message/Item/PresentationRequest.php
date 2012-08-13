<?php
/**
 * Презентационный запрос
 */
class Domain_Message_Item_PresentationRequest {
    
    /**
     * ID ученика
     * @var integer
     */
    private $studentId;
    
    /**
     * Создаёт экземпляр класса
     * @param integer $studentId ID ученика
     */
    public function __construct($studentId) {
        
        $this->studentId = $studentId;
        
    }
    
    /**
     * Сообщает ID ученика
     * @return integer
     */
    public function getStudentId() {
        
        return $this->studentId;
        
    }
    
}
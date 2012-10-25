<?php
/**
 * Посещение части урока
 */
class Data_State_Item_Visit extends Data_State_Item_Abstract {
    
    /**
     * ID урока
     * @var integer
     */
    private $lessonId = null;
    public function setLessonId($lessonId) {
        $this->lessonId = $lessonId;
    }
    public function getLessonId() {
        return $this->lessonId;
    }
    
    /**
     * ID части урока
     * @var integer
     */
    private $partId = null;
    public function setPartId($partId) {
        $this->partId = $partId;
    }
    public function getPartId() {
        return $this->partId;
    }
    
    /**
     * ID ученика
     * @var integer
     */
    private $studentId = null;
    public function setStudentId($studentId) {
        $this->studentId = $studentId;
    }
    public function getStudentId() {
        return $this->studentId;
    }
    
    /**
     * ID учителя
     * @var integer
     */
    private $teacherId = null;
    public function setTeacherId($teacherId) {
        $this->teacherId = $teacherId;
    }
    public function getTeacherId() {
        return $this->teacherId;
    }
    
}
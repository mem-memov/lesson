<?php
class Domain_School {
    
    private $lessonCollection;
    private $studentCollection;
    private $teacherCollection;
    
    public function __construct(
        Domain_Collection_Interface $lessonCollection,
        Domain_Collection_Interface $studentCollection,
        Domain_Collection_TeacherInterface $teacherCollection
    ) {
        
        $this->lessonCollection = $lessonCollection;
        $this->studentCollection = $studentCollection;
        $this->teacherCollection = $teacherCollection;
        
    }
    
    /**
     * Возвращает параметры следующей части урока
     * @param int $studentId
     * @param int $lessonId
     */
    public function educate($studentId, $lessonId) {
        
        $lesson = $this->lessonCollection->readUsingId($lessonId);
        $student = $this->studentCollection->readUsingId($studentId);
        $teacher = $this->teacherCollection->readUsingLessonId($lessonId);

        $teacher->teach($lesson);
        $student->learn($lesson);
        
        $presentationArray = $lesson->getPresentation();
        
        return $presentationArray;
        
    }
    
    public function prepareLesson($teacherId, $lessonArray) {
        
    }
    
    public function payWages($teacherId, $amount) {
        
        $teacher = $this->teacherCollection->readUsingId($id);
        
    }
    
    public function receiveTuition($studentId, $amount) {
        
        $student = $this->studentCollection->readUsingId($studentId);
        
    }
    
}
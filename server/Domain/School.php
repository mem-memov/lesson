<?php
/**
 * Школа
 */
class Domain_School {
    
    private $lessonCollection;
    private $studentCollection;
    private $teacherCollection;
    
    public function __construct(
        Domain_Collection_Lesson $lessonCollection,
        Domain_Collection_Student $studentCollection,
        Domain_Collection_Teacher $teacherCollection
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
    
    /**
     * Подготавливает урок
     * @param integer $teacherId
     * @param integer|null $lesson Null означает, что нужно создать новый урок
     * @return Domain_Lesson
     */
    public function prepareLesson($teacherId, $lesson = null) {
        
        $teacher = $this->teacherCollection->readUsingId($teacherId);

        $lesson = $teacher->prepare($lesson);
        
        return $lesson;
        
    }
    
    public function offerLessons($filter) {
        
        return $this->lessonCollection->readUsingFilter($filter);

    }
    
    public function payWages($teacherId, $amount) {
        
        $teacher = $this->teacherCollection->readUsingId($id);
        
    }
    
    public function receiveTuition($studentId, $amount) {
        
        $student = $this->studentCollection->readUsingId($studentId);
        
    }
    
}
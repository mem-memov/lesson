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
    
    public function prepareLesson($teacherId, $lessonArray) {
        
        $teacher = $this->teacherCollection->readUsingId($teacherId);

        $lesson = $teacher->prepare($lessonArray);
        
        return $lesson->toArray();
        
    }
    
    public function offerLessons($filter) {
        
        $lessons = $this->lessonCollection->readUsingFilter($filter);
      
        $lessonArrays = array();
        foreach($lessons as $lesson) {
            $lessonArrays[] = $lesson->toArray();
        }
 
        return $lessonArrays;
    }
    
    public function payWages($teacherId, $amount) {
        
        $teacher = $this->teacherCollection->readUsingId($id);
        
    }
    
    public function receiveTuition($studentId, $amount) {
        
        $student = $this->studentCollection->readUsingId($studentId);
        
    }
    
}
<?php
/**
 * Школа
 */
class Domain_School {
    
    private $lessonCollection;
    private $studentCollection;
    private $teacherCollection;
    private $visitCollection;
    
    public function __construct(
        Domain_Collection_Lesson $lessonCollection,
        Domain_Collection_Student $studentCollection,
        Domain_Collection_Teacher $teacherCollection,
        Domain_Collection_Visit $visitCollection
    ) {
        
        $this->lessonCollection = $lessonCollection;
        $this->studentCollection = $studentCollection;
        $this->teacherCollection = $teacherCollection;
        $this->visitCollection = $visitCollection;
        
    }
    
    /**
     * Возвращает параметры следующей части урока
     * @param int $studentId
     * @param int $lessonId
     */
    public function educate($studentId, $lessonId) {

        $lesson = $this->lessonCollection->readUsingId($lessonId);
        $student = $this->studentCollection->readUsingId($studentId);
        $teacher = $this->teacherCollection->readUsingId($lesson->getTeacherId());
        
        $filter = array('lesson_id' => $lessonId, 'student_id' => $studentId);
        $visits = $this->visitCollection->readUsingFilter($filter);
        if (empty($visits)) {
            $partId = $lesson->getNextPartId();
            $visit = $this->visitCollection->create($lessonId, $partId, $teacher->getId(), $studentId);
        } else {
            $visit = $visits[0];
            $partId = $visit->getPartId();
        }
        

        //$teacher->teach($lesson);
        //$student->learn($lesson);
        
        //$presentationArray = $lesson->getPresentation();
        
        //return $presentationArray;
        if (!$lesson->hasNextPartId($partId)) {
            $this->visitCollection->delete($visit);
        } else {
            
        
            $nextPartId = $lesson->getNextPartId($partId);
            $visit->setPartId($nextPartId);
            $this->visitCollection->update($visit);

            return $lesson->showPart($partId);
        
        }
        
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
<?php
/**
 * Школа
 */
class Domain_School {
    
    private $teacherCollection;
    private $educationRequestFactory;
    
    public function __construct(
        Domain_Collection_Teacher $teacherCollection,
        Domain_Message_Factory_EducationRequest $educationRequestFactory
    ) {

        $this->teacherCollection = $teacherCollection;
        $this->educationRequestFactory = $educationRequestFactory;
        
    }
    
    /**
     * Возвращает параметры следующей части урока
     * @param int $studentId
     * @param int $lessonId
     * @return arra Description
     */
    public function educate($studentId, $lessonId) {
        
        $educationRequest = $this->educationRequestFactory->makeMessage($studentId, $lessonId);
        $teacher = $this->teacherCollection->readUsingLessonId($lessonId);
        $educationResponce = $teacher->teach($educationRequest);
        
        return $educationResponce;
        
        
        
        $filter = array('lesson_id' => $lessonId, 'student_id' => $studentId);
        $visits = $this->visitCollection->readUsingFilter($filter);
        if (empty($visits)) {
            $visit = $this->visitCollection->create($lessonId, $studentId);
        } else {
            $visit = $visits[0];
        }
        
        $data = $visit->happen();
        
        $visit = $this->visitCollection->update($visit);
        
        return $data;
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        $lesson = $this->lessonCollection->readUsingId($lessonId);
        
        $lesson->beArrangedForStudent($studentId);

        return $lesson;
        
        
        
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
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
     * @return Domain_Message_Item_Presentation показ
     */
    public function educate($studentId, $lessonId) {

        $educationRequest = $this->educationRequestFactory->makeMessage($studentId, $lessonId);
        $teacher = $this->teacherCollection->readUsingLessonId($lessonId);
        $presentation = $teacher->teach($educationRequest);
        
        return $presentation;

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
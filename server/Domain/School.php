<?php
/**
 * Школа
 */
class Domain_School {
    
    private $teacherCollection;
    private $lessonCollection;
    private $educationRequestFactory;
    
    public function __construct(
        Domain_Collection_Teacher $teacherCollection,
        Domain_Collection_Lesson $lessonCollection,
        Domain_Message_Factory_EducationRequest $educationRequestFactory
    ) {

        $this->teacherCollection = $teacherCollection;
        $this->lessonCollection = $lessonCollection;
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
     * @param integer|null $lessonId Null означает, что нужно создать новый урок
     * @param Domain_Lesson|null новый вариант урока
     * @return Domain_Lesson
     */
    public function prepareLesson($teacherId, $lessonId = null, $newVersion = null) {
        
        $teacher = $this->teacherCollection->readUsingId($teacherId);

        $lesson = $teacher->prepare($lessonId, $newVersion);
        
        return $lesson;
        
    }
    
    public function offerLessons($filter) {
        
        $lessons = $this->lessonCollection->readUsingFilter($filter);
        
        $presentations = array();
        foreach ($lessons as $lesson) {
            
            $presentations[] = $lesson->bePresented();
            
        }
        
        return $presentations;

    }
    
    public function payWages($teacherId, $amount) {
        
        $teacher = $this->teacherCollection->readUsingId($id);
        
    }
    
    public function receiveTuition($studentId, $amount) {
        
        $student = $this->studentCollection->readUsingId($studentId);
        
    }
    
}
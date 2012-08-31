<?php
/**
 * Школа
 */
class Domain_School {
    
    /**
     * Фабрика сообщений
     * @var Domain_Message_School_Factory 
     */
    private $messageFactory;
    
    private $teacherCollection;
    private $studentCollection;
    private $lessonCollection;
    
    public function __construct(
        Domain_Message_School_Factory $messageFactory,
        Domain_Collection_Teacher $teacherCollection,
        Domain_Collection_Student $studentCollection,
        Domain_Collection_Lesson $lessonCollection
    ) {

        $this->messageFactory = $messageFactory;
        $this->teacherCollection = $teacherCollection;
        $this->studentCollection = $studentCollection;
        $this->lessonCollection = $lessonCollection;

    }
    
    /**
     * Возвращает параметры следующей части урока
     * @param int $studentId
     * @param int $lessonId
     * @return Domain_Message_Item_Presentation показ
     */
    public function educate($studentId, $lessonId) {

        $educationRequest = $this->messageFactory->makeEducationRequest($studentId, $lessonId);
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
    
    /**
     * 
     * @param integer $studentId
     * @param integer $amount
     * @return Domain_Message_Account_Response_AccountPresentation
     */
    public function receiveTuition($studentId, $amount = null) {

        $student = $this->studentCollection->readUsingId($studentId);
        $accountPresentation = $student->deposit($amount);
        
        return $accountPresentation;
        
    }
    
}
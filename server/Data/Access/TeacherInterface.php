<?php
interface Data_Access_TeacherInterface extends Data_Access_Crud_Interface {
    
    public function readUsingLessonId($lessonId);
    
}
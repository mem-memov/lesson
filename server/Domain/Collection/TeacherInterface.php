<?php
interface Domain_Collection_TeacherInterface extends Domain_Collection_Interface {
    
    public function readUsingLessonId($lessonId);
    
}
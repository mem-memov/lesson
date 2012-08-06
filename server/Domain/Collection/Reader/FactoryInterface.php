<?php
interface Domain_Collection_Reader_FactoryInterface {
    
    public function makeAccount();
    public function makeLesson();
    public function makeStudent();
    public function makeTeacher();
    public function makeTeacherUsingLessinId();
    
}
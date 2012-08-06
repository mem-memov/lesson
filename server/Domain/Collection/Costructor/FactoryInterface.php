<?php
interface Domain_Collection_Constructor_FactoryInterface {
    
    public function makeAccount();
    public function makeLesson();
    public function makeStudent();
    public function makeTeacher();
    
}
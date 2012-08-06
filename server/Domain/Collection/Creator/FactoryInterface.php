<?php
interface Domain_Collection_Creator_FactoryInterface {
    
    public function makeAccount();
    public function makeLesson();
    public function makeStudent();
    public function makeTeacher();
    
}
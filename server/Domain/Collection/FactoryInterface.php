<?php
interface Domain_Collection_FactoryInterface {
    
    public function makeAccountCollection();
    public function makeLessonCollection();
    public function makeStudentCollection();
    public function makeTeacherCollection();
    
}
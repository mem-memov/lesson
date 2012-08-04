<?php
interface Data_State_FactoryInterface {
    
    public function makeAccountFactory();
    public function makeLessonFactory();
    public function makeStudentFactory();
    public function makeTeacherFactory();
    
}
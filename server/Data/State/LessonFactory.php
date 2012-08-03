<?php
class Data_State_LessonFactory implements Data_Sate_StateFactoryInterface {
    
    public function makeState() {
        
        return new Data_State_Lesson();
        
    }
    
}

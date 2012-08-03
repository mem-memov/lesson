<?php
class Domain_LessonCollection extends Domain_AbstractCollection {
    
    protected function make(Data_State_Lesson_Item $state) {
        
        return new Domain_Lesson($state);
        
    }
    
}

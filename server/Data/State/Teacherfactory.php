<?php
class Data_State_TeacherFactory implements Data_Sate_StateFactoryInterface {
    
    public function makeState() {
        
        return new Data_State_Teacher();
        
    }
    
}

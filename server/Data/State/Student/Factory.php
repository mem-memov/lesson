<?php
class Data_State_Student_Factory implements Data_Sate_StateFactoryInterface {
    
    public function makeState() {
        
        return new Data_State_Student_Item();
        
    }
    
}

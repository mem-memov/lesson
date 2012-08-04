<?php
class Domain_Collection_Teacher 
extends Domain_Collection_Base 
implements
    Domain_Collection_TeacherInterface
{
    
    public function readUsingLessonId($lessonId) {
        
        $state = $this->dataAccess->readUsingLessonId($lessonId);
        $item = $this->maker->make($state);
        $this->states[spl_object_hash($item)] = $state;
        return $item;
        
    }

}

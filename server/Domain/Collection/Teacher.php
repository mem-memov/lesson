<?php
class Domain_Collection_Teacher 
extends Domain_Collection_Base 
implements
    Domain_Collection_Reader_InterfaceUsingLessonId
{
    
    private $readerUsingLessonId;
    
    public function __construct(
        Domain_Collection_Creator_Interface $creator,
        Domain_Collection_Reader_Interface $reader,
        Domain_Collection_Updater_Interface $updater,
        Domain_Collection_Deleter_Interface $deleter,
        Domain_Collection_Reader_InterfaceUsingLessonId $readerUsingLessonId
    ) {
        
        parent::__construct($creator, $reader, $updater, $deleter);
        
        $this->readerUsingLessonId = $readerUsingLessonId;
        
    }
    
    public function readUsingLessonId($lessonId) {

        return $readerUsingLessonId->readUsingLessonId($id);
        
    }

}

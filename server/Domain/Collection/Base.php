<?php
class Domain_Collection_Base 
implements
    Domain_Collection_Interface
{
    
    protected $creator;
    protected $reader;
    protected $updater;
    protected $deleter;
    
    public function __construct(
        Domain_Collection_Creator_Interface $creator,
        Domain_Collection_Reader_Interface $reader,
        Domain_Collection_Updater_Interface $updater,
        Domain_Collection_Deleter_Interface $deleter
    ) {
        
        $this->creator = $creator;
        $this->reader = $reader;
        $this->updater = $updater;
        $this->deleter = $deleter;
        
    }
    
    public function create() {
        return $this->creator->create();
    }
    
    public function readUsingId($id) {
        return $this->reader->readUsingId($id);
    }
    
    public function update($item) {
        $this->updater->update($item);
    }
    
    public function delete($item) {
        $this->deleter->delete($item);
    }
    
}
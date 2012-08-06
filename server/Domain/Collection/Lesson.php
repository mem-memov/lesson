<?php
class Domain_Collection_Lesson {

    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_Crud_Teacher 
     */
    private $dataAccess;
    
    /**
     * Состояния
     * @var array 
     */
    private $states;

    
    public function __construct(
        Data_Access_Crud_Teacher $dataAcces
    ) {
        
        $this->dataAccess = $dataAccess;
        
        $this->states = array();
        
    }
    
    public function create() {
        $state = $this->dataAccess->create();
        $item = $this->make($state);
        $this->states[spl_object_hash($item)] = $state;
        return $item;
    }
    
    public function readUsingId($id) {
        $state = $this->dataAccess->readUsingId($id);
        $item = $this->make($state);
        $this->states[spl_object_hash($item)] = $state;
        return $item;
    }
    
    public function readUsingTeacherId($teacherId) {
        $state = $this->dataAccess->readUsingTeacherId($teacherId);
        $item = $this->make($state);
        $this->states[spl_object_hash($item)] = $state;
        return $item;
    }
    
    public function readUsingStudentId($studentId) {
        $state = $this->dataAccess->readUsingStudentId($studentId);
        $item = $this->make($state);
        $this->states[spl_object_hash($item)] = $state;
        return $item;
    }
    
    public function update($item) {
        $this->dataAccess->update($this->states[spl_object_hash($item)]);
    }
    
    public function delete($item) {
        $this->dataAccess->delete($this->states[spl_object_hash($item)]);
        unset($this->states[spl_object_hash($item)]);
    }
    
    private function make($state) {
        
        return new Domain_Lesson($state);
        
    }
    
}

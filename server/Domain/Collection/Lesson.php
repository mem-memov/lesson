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
    
    /**
     * Коллекция частей урока
     * @var Domain_Collection_Part
     */
    private $partCollection;

    
    public function __construct(
        Data_Access_Lesson $dataAccess,
        Domain_Collection_Part $partCollection
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->partCollection = $partCollection;
        
        $this->states = array();
        
    }
    
    public function create($title, $description, $teacherId) {
        
        $state = $this->dataAccess->create();
        
        $state->setTitle($title);
        $state->setDescription($description);
        $state->setTeacherId($teacherId);
        
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
    
    public function readUsingFilter($filter) {
        
        $states = $this->dataAccess->readUsingFilter($filter);
        
        $items = array();
        foreach ($states as $state) {
            $item = $this->make($state);
            $this->states[spl_object_hash($item)] = $state;
            $items[] = $item;
        }

        return $items;
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
        
        return new Domain_Lesson($state, $this->partCollection);
        
    }
    
}

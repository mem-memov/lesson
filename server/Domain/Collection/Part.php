<?php
class Domain_Collection_Part {

    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_Part
     */
    private $dataAccess; 
    
    /**
     * Состояния
     * @var array 
     */
    private $states;

    /**
     * Коллекция тексов
     * @var Domain_Collection_Text
     */
    private $textCollection;

    
    public function __construct(
        Data_Access_Part $dataAccess,
        Domain_Collection_Text $textCollection
    ) {
        
        $this->dataAccess = $dataAccess;
        $this->textCollection = $textCollection;
        
        $this->states = array();
        
    }
    
    /**
     * Создаёт часть урока
     * @param integer $lessonId
     * @return Domain_Part
     */
    public function create($lessonId) {
        
        $state = $this->dataAccess->create();
        
        $state->setLessonId($lessonId);
        
        $item = $this->make($state);
        
        $this->states[spl_object_hash($item)] = $state;
        
        return $item;
        
    }
    
    /**
     * Извлекает часть урока по ID
     * @param integer $id
     * @return Domain_Part
     */
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
    
    public function update($item) {
        $this->dataAccess->update($this->states[spl_object_hash($item)]);
    }
    
    public function delete($item) {
        $this->dataAccess->delete($this->states[spl_object_hash($item)]);
        unset($this->states[spl_object_hash($item)]);
    }
    
    private function make($state) {
        
        return new Domain_Part(
            $state, 
            $this->textCollection
        );
        
    }
    
}
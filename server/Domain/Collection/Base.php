<?php
class Domain_Collection_Base 
implements
    Domain_Collection_Interface
{
    
    /**
     * Объект доступа к данным (DAO)
     * @var Data_Access_CrudInterface 
     */
    protected $dataAccess;
    
    /**
     * Набор состояний элементов коллекции
     * @var array 
     */
    protected $states;
    
    /**
     * Объект для создания элементов коллекции
     * @var Domain_Collection_Maker_Interface 
     */
    protected $maker;
    
    public function __construct(
        Domain_Collection_Maker_Interface $maker
    ) {
        
        $this->maker = $maker;
        
    }
    
    public function create() {
        $state = $this->dataAccess->create();
        $item = $this->maker->make($state);
        $this->states[spl_object_hash($item)] = $state;
        return $item;
    }
    
    public function readUsingId($id) {
        $state = $this->dataAccess->readUsingId($id);
        $item = $this->maker->make($state);
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
    
}
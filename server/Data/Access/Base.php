<?php
class Data_Access_Base implements Data_Access_Crud_Interface {
    
    private $crud;
    
    public function __construct(
        Data_Access_Crud_Interface $crud
    ) {
        
        $this->crud = $crud;
        
    }
    
    public function create() {
        
        return $this->crud->create();

    }
    
    public function readUsingId($id) {

        return $this->crud->readUsingId($id);
        
    }
    
    public function update(Data_State_Item_TrackableInterface $state) {
        
        $this->crud->update($state);
        
    }
    
    public function delete(Data_State_Item_TrackableInterface $state) {
        
        $this->crud->delete($state);
        
    }
    
}

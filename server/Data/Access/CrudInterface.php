<?php
interface Data_Access_CrudInterface {
    
    public function create();
    
    public function readUsingId($id);
    
    public function update(Data_State_TrackableInterface $state);
    
    public function delete(Data_State_TrackableInterface $state);
    
}
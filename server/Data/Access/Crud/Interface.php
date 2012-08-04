<?php
interface Data_Access_Crud_Interface {
    
    public function create();
    
    public function readUsingId($id);
    
    public function update(Data_State_Item_TrackableInterface $state);
    
    public function delete(Data_State_Item_TrackableInterface $state);
    
}
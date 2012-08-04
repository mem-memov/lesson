<?php
interface Domain_Collection_Interface {
    
    public function create();
    public function readUsingId($id);
    public function update($item);
    public function delete($item);
    
}
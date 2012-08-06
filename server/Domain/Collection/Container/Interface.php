<?php
interface Domain_Collection_Container_Interface {
    
    public function add($keyObject, $valueObject);
    public function remove($keyObject);
    public function get($keyObject);
    public function has($keyObject);

}
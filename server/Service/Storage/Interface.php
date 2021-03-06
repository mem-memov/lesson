<?php
interface Service_Storage_Interface {
    
    public function query($query);
    public function fetchRows($query);
    public function fetchRow($query);
    public function fetchIdRows($query, $id_field);
    public function fetchColumns($query, array $fields);
    public function fetchColumn($query, $field);
    public function fetchValue($query, $field = null);
    public function lastId();
    public function affectedRows();
    
}

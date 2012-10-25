<?php
class Service_Installer_Mysql_Installer implements Service_Installer_Interface {
    
    private $storage;
    
    public function __construct(
        Service_Storage_Mysql_Adapter $storage
    ) {
        
        $this->storage = $storage;
        
    }
    
    public function install() {
        
        $this->createTables();
        //$this->insertData();
        
    }
    
    private function createTables() {
        
        $sql_files = glob(dirname(__FILE__).'/sql_tables/*.sql');
        
        foreach ($sql_files as $sql_file) {
            
            $query = file_get_contents($sql_file);
         
            $this->storage->query($query);
            
        }

    }
    
    private function insertData() {
        
        $sql_files = glob(dirname(__FILE__).'/sql_data/*.sql');
        
        foreach ($sql_files as $sql_file) {
            
            $query = file_get_contents($sql_file);
         
            $this->storage->query($query);
            
        }

    }
    
}
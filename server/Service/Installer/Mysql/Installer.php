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
        
    }
    
    private function createTables() {
        
        $sql_files = glob(dirname(__FILE__).'/sql_tables/*.sql');
        
        foreach ($sql_files as $sql_file) {
            
            $query = preg_replace('/^.*\/(.*)\.sql$/', '$1', $sql_file);
         
            $this->storage->query($query);
            
        }

    }
    
}
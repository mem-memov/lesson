<?php
class Service_Storage_Mysql_Adapter implements Service_Storage_Interface {

    private $server;
    private $user;
    private $password;
    private $database;

    private $connection;
    private $last_query;

    public function __construct($server, $user, $password, $database) {

        $this->server = $server;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;

        $this->connection = null;
        $this->last_query = null;


    }
    public function __destruct() {
            if (!is_null($this->connection)) {
                    mysql_close($this->connection);
            }
    }

    private function connect() {

        $this->connection = mysql_connect($this->server, $this->user, $this->password);
        
        if ($this->connection === false) {
            throw new Service_Storage_Mysql_Exception('Could not connect: ' . mysql_error());
        }
        
        $ok = mysql_select_db($this->database, $this->connection);
            
        if ($ok === false) {
            throw new Service_Storage_Mysql_Exception('Can\'t use '.$this->database.' : ' . mysql_error());
        }

    }

    public function query($query) {

        if (is_null($this->connection)) {
            $this->connect();
        }

        $this->last_query = $query;
        $result = mysql_query($query, $this->connection);
        if (!$result) {
            $output = 'Database query failed: '.'<br />'."\n".mysql_error().'<br />'."\n";
            $output .= 'Last query:'.'<br />'."\n".$this->last_query;
            throw new Service_Storage_Mysql_Exception ($output);
        }

        return $result;

    }

    public function fetchRows($query) {

        $rows = array();

        $result = $this->query ($query);
        while ($row = mysql_fetch_assoc($result)) {
            $rows[] = $row;
        }
        mysql_free_result($result);

        return $rows;

    }
    public function fetchRow($query) {

        $rows = $this->fetchRows($query);

        if (isset($rows[0])) {
            $row = $rows[0];
        }else{
            $row = array();
        }

        return $row;

    }
    public function fetchIdRows($query, $id_field) {

        $id_rows = array();

        $rows = $this->fetchRows($query);

        foreach ($rows as $row) {
            $id_rows[$row[$id_field]] = $row;
        }

        return $id_rows;

    }
    public function fetchColumns($query, array $fields) {

        $columns = array();
        
        foreach ($fields as $field) {
            $columns[$field] = array();
        }

        $rows = $this->fetchRows($query);
        foreach ($rows as $row) {
            foreach ($row as $field => $value) {
                $columns[$field][] = $value;
            }
        }

        return $columns;

    }
    public function fetchColumn($query, $field) {

        $columns = $this->fetchColumns($query, array($field));

        return $columns[$field];

    }
    public function fetchValue($query, $field = null) {

        $row = $this->fetchRow($query);

        if (count($row) > 0) {
            if (is_null($field)) {
                $value = array_shift($row);
            }else{
                if (isset($row[$field])) {
                    $value = $row[$field];
                }else{
                    $value = null;
                }
            }
        }else{
            $value = null;
        }

        return $value;

    }

    public function lastId() {

        $lastId = mysql_insert_id($this->connection);

        if ($lastId == 0) {
            $lastId = null;
        }

        return $lastId;

    }

    public function affectedRows() {

        $affectedRows = mysql_affected_rows($this->connection);

        return $affectedRows;

    }

}

<?php
class DBConnection{
    // properties
    private $host = 'localhost';
    // private $dbname = 'bulkmailing_db';
    // private $dbuser = 'root';
    // private $dbpass = '';
    private $dbname = 'nglohite_bulk';
	private $dbuser = 'nglohite_bulk';
    private $dbpass = '$E}G9TDdlMX7';
    
    // class constructor
    public function __construct(){
        $dbconn = new mysqli($this->host, $this->dbuser, $this->dbpass, $this->dbname);
        return $dbconn;
    }
}
?>
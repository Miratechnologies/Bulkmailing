<?php
class DBConnection{
   // properties
   private $host = 'localhost';
   // Dev
   // private $dbname = 'bulkmailing_db';
   // private $dbuser = 'root';
   // private $dbpass = '';
   // Test
   // private $dbname = 'nglohite_bulk';
	// private $dbuser = 'nglohite_bulk';
   // private $dbpass = '$E}G9TDdlMX7';
   // Live
   private $dbname = 'obejorgr_bulkmailing';
	private $dbuser = 'obejorgr_bulkmailing';
   private $dbpass = 'g5kGbuuYjRjp';

   // class constructor
   public function __construct(){
      $dbconn = new mysqli($this->host, $this->dbuser, $this->dbpass, $this->dbname);
      return $dbconn;
   }
}
?>

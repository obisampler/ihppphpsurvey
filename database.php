<?php
/*
* Mysql database class - only one connection alowed
* @author jonashansen229@github
* @author obi
*/
class Database {
	private $_connection;
	private static $_instance; //The single instance
	private $_host = ":/tmp/mysql.sock";
	private $_username = "root";
	private $_password = "";
	private $_database = "ihpdemo";

	/*
	Get an instance of the Database
	@return Instance
	*/
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	// Constructor
	private function __construct() {
		$this->_connection = mysql_connect($this->_host, $this->_username, 
			$this->_password, $this->_database);
	
		// Error handling
		if(!$this->_connection) {
			trigger_error("Failed to connect to to MariaDb: " . mysql_error(),
				 E_USER_ERROR);
		}
	}

	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }

	// Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}
}
?>
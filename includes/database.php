<?php
require_once("config.php");

class MySQLDatabase {
	private $connection;
	private $last_query;
	private $escape_value;
	
	function __construct(){
		$this->open_connection();
	}

	public function open_connection(){
		$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$this->connection){
			die("Database connection failed: ");
		}else{
			return $this->connection;

		}
	}

	public function close_connection(){
		if(isset($this->connection)){
			mysqli_close($this->connection);
			unset($this->connection);
		}
	}

	public function query($sql){
		$this->last_query = $sql;
		$result = mysqli_query($this->connection, $sql);
		$this->confirm_query($result);
		return $result;
	}

	private function confirm_query($result){
		if(!$result){
			$output= "Database query failed: ". mysqli_error($this->connection) ."<br/><br/>";
			$output .= "Last SQL query: " . $this->last_query;
			die($output);
		}
	}

	public function escape_value( $sql){
		return mysqli_real_escape_string($this->connection, $sql);
	}

	public function fetch_array($result_set){
		return mysqli_fetch_array($result_set);
	}

	public function num_rows($result_set){
		return mysqli_num_rows($result_set);
	}

	public function insert_id(){
		return mysqli_insert_id($this->connection);
	}

	public function affected_rows(){
		return mysqli_affected_rows($this->connection);
	}




} //end class	

$db = new MySQLDatabase;

<?php
require_once('database.php');

class User extends DatabaseObject{

	protected static $table_name = "user";

	public $id;
    public $company_id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
    public $email;
    public $access;
    public $active;

public function full_name(){
		if(isset($this->first_name) && isset($this->last_name)){
			return $this->first_name . " " .$this->last_name;
		}else{
			return "";
		}
}
public static function authenticate($username, $password){
	global $db;
	//$username = $db->escape_value($username);
	//$password = $db->escape_value($password);
	$sql  = "select * from user ";
	$sql .= "where username = '{$username}' ";
	$sql .= "and password = '{$password}' ";
	$sql .= "limit 1";
	$result_array = self::find_by_sql($sql);
	return !empty($result_array) ? array_shift($result_array) : false;
}


}//end class
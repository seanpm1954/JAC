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

    public  function find_Names($comp_id){
        global $db;
        $sql  = "select * from user ";
        $sql .= "where company_id ='{$comp_id}'";
        $result_set = $db->query($sql);
        //$object_array = array();
        while ($row = $db->fetch_array($result_set)){
            //$object_array[] = $row;
            //echo "<option value='$row->id'>test</option>";
            echo '<option value="'. $row['id'] .'">'. $row['first_name'] . " ". $row['last_name'].'</option>';
        }
        //return $object_array;
}

    public  function get_details($comp_id){
        global $db;
        $sql  = "select username,password,first_name,last_name,email from user ";
        $sql .= "where id ='{$comp_id}' limit 1";
        $result_set = $db->query($sql);
        $object_array = array();
        while ($row = $db->fetch_array($result_set)){
            $object_array[] = $row;
            //echo '<option value="'. $row['username'] .'">'. $row['first_name'] . " ". $row['last_name'].'</option>';
            //echo '<input type="text" value="'. $row['first_name'] .'">';
        }
        echo json_encode($object_array);
    }

    static public function updateName1($id,$username1,$password1,$first_name1,$last_name1, $email1){
        global $db;
        $sql="update user set username='{$username1}',password='{$password1}',first_name='{$first_name1}',last_name='{$last_name1}',email='{$email1}' where id={$id}";
        $db->query($sql);
        return ($db->affected_rows() == 1) ? true : false;

    }
    static public function saveName($comp_id,$username1,$password1,$first_name1,$last_name1, $email1){
        global $db;
        $sql="insert into user (company_id,first_name,last_name,email,password,username,access,active) values ('{$comp_id}','{$first_name1}','{$last_name1}','{$email1}','{$password1}','{$username1}',1,0)";
        if($db->query($sql)){
            $id = $db->insert_id();
            return true;
        }else{
            return false;
        }

    }

static public function deleteUser($id){
    global $db;
    $sql = "delete from user  WHERE id='{$id}'";
    $db->query($sql);
    return ($db->affected_rows()==1) ? true : false;
}


}//end class
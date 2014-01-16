<?php
require_once('database.php');

class Company extends DatabaseObject{

	protected static $table_name = "company";

    public $id;
	public $company_name;

    static public function get_cName($id){
        global $db;
        $sql="select company_name from company where id={$id} limit 1";

        $result = $db->query($sql);
        $row = $result->fetch_array();

        return $row['company_name'];


    }

    static public function saveName($cName){
        global $db;
        $sql="insert into company (company_name) values ('{$cName}')";
        if($db->query($sql)){
           $id = $db->insert_id();
            return true;
        }else{
            return false;
        }

    }

    static public function updateName($id,$cName){
        global $db;
        $sql="update company set company_name='{$cName}' where id={$id}";
        $db->query($sql);
         return ($db->affected_rows() == 1) ? true : false;

    }

}//end class
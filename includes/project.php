<?php
require_once('database.php');

class Project extends DatabaseObject{

	protected static $table_name = "project";

	public $id;
    public $company_id;
	public $project_name;

    static public function saveProject($comp_id,$proj_name){
        global $db;
        $sql="insert into project (company_id, project_name) values ('{$comp_id}','{$proj_name}')";
        if($db->query($sql)){
            $id = $db->insert_id();
            return true;
        }else{
            return false;
        }

    }
}//end class
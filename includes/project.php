<?php
require_once('database.php');

class Project extends DatabaseObject{

	protected static $table_name = "project";

	public $id;
    public $company_id;
	public $project_name;


}//end class
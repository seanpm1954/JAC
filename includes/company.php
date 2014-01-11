<?php
require_once('database.php');

class Company extends DatabaseObject{

	protected static $table_name = "company";

    public $id;
	public $company_name;


}//end class
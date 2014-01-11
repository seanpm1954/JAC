<?php
require_once('database.php');

class DatabaseObject {

protected static $table_name;

//common Database methods moved from user.php
public static function find_all(){
		return static::find_by_sql("select * from ".static::$table_name);
}

public static function find_by_id($id=0){
		global $db;
		$result_array = static::find_by_sql("select * from ".static::$table_name." where id={$id} limit 1");
		
		return !empty($result_array) ? array_shift($result_array) : false;
}

public static function find_by_sql($sql=""){
		global $db;
		$result_set = $db->query($sql);
		$object_array = array();
		while ($row = $db->fetch_array($result_set)){
			$object_array[] = static::instantiate($row);
		}
		return $object_array;
}

private static function instantiate($record){

		$class_name = get_called_class();
		$object = new $class_name;

		foreach ($record as $attribute => $value) {
			if($object->has_attribute($attribute)){
				$object->$attribute = $value;
			}
		}
		return $object;
}

private function has_attribute($attribute){
		$object_vars = $this->attributes();
		return array_key_exists($attribute, $object_vars);
}

    protected function attributes(){
        // look at mySQL show fields from()

        //includes private & protected...
        return get_object_vars($this);
//        $attributes = array();
//        foreach(self::$db_fields as $field){
//            if(property_exists($this, $field)){
//                $attributes[$field] = $this->$field;
//            }
//        }
    }
    protected function sanitized_attributes(){
        global $db;
        $clean_attributes = array();
        foreach($this->attributes() as $key => $value){
            $clean_attributes[$key] = $db->escape_value($value);
        }
    }
    public function save(){
        return isset($this->id) ? $this->update() : $this->create();
    }
    public function create(){
        //add company to uploads/companyname
        global $db;
        $attributes = $this->attributes();
        //USER Table
        //take off id from 1st element in array
        if(static::$table_name=='user'){
            $attributes1= array_shift($attributes);
        }
        //proj_file_loc table
        //pop last 3 items in proj_file_loc array
        if(static::$table_name=='proj_file_loc'){
            for($i=0;$i<3;$i++){
            $attributes1= array_pop($attributes);
        } //the remove id
            $attributes1= array_shift($attributes);
        }

        //resume for all db's
        $sql = "insert into ".static::$table_name." (";
        $sql .= join(", ",array_keys($attributes));
        $sql .= ") values ('";
        $sql .= join("' ,'",array_values($attributes));
        $sql .= "')";
        if($db->query($sql)){
            $this->id = $db->insert_id();
            return true;
        }else{
            return false;
        }

    }

    public function update(){
        global $db;
        //$attributes =$this->sanitized_attributes();
        $attributes =$this->attributes();
        $attributes1= array_shift($attributes);
        $attribute_pairs = array();
        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE ".static::$table_name." SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE id=". $db->escape_value($this->id);
        $db->query($sql);
        return ($db->affected_rows() == 1) ? true : false;
    }

    public  function delete(){
        global $db;
        $sql = "delete from ".static::$table_name." WHERE id=".$db->escape_value($this->id);
        $sql .= " limit 1";
        $db->query($sql);
        return ($db->affected_rows()==1) ? true : false;




    }


} //end class

<?php
require_once LIB_PATH.DS."database.php";
class ProjectFiles extends DatabaseObject {
    protected static $table_name ="projectfiles";
    protected static $db_fields = array('proj_file_id', 'project_id', 'proj_file_loc');

    public $id;
    public $project_id;
    public $proj_file_loc;

    private $temp_path;
    protected $upload_dir ="uploads";
    public $errors =array();

protected  $upload_errors = array(
UPLOAD_ERR_OK               => "No errors.",
UPLOAD_ERR_INI_SIZE         => "Larger than upload_max_size.",
UPLOAD_ERR_FORM_SIZE		=> "Larger than form MAX_FILE_SIZE.",
UPLOAD_ERR_PARTIAL			=> "Partial upload.",
UPLOAD_ERR_NO_FILE			=> "No file.",
UPLOAD_ERR_NO_TMP_DIR		=> "No temporary directory.",
UPLOAD_ERR_CANT_WRITE 		=> "Can't write to disk.",
UPLOAD_ERR_EXTENSION 		=> "File upload stooped by extension."
);

    public function image_path(){
        return $this->upload_dir.DS.$this->filename;
    }

    public  function size_as_text(){
        if($this->size <1024){
            return "{$this->size} bytes";
        }elseif($this->size <1048576){
            $size_kb=round($this->size/1024);
            return "{$size_kb} KB";
        }else{
            $size_mb=round($this->size/1048576,1);
            return "{$size_mb} MB";
        }
    }

    public function attach_file($file){
        if(!$file || empty($file) || !is_array($file)){
            $this->errors[] = "No file was uploaded";
            return false;
        }elseif($file['error'] != 0){
            $this->errors[]= $this->upload_errors[$file['error']];
            return false;
        }else{
            $this->temp_path = $file['tmp_name'];
            $this->filename = basename($file['name']);
            $this->type = $file['type'];
            $this->size = $file['size'];

            return true;
        }

    }

    public function save(){
        //overwrite datbaseObject save()
        if(isset($this->id)){
            parent::update();
        }else{ //no errors
            if(!empty($this->errors)){ return false;}


            if(empty($this->filename)  || empty($this->temp_path)){
                $this->errors[]="The file location was not available";
                return false;
            }
            //target path
            $target_path = SITE_ROOT.DS.$this->upload_dir.DS.$this->filename;
            //chk exists?

            //attempt to move file
            if(move_uploaded_file($this->temp_path, $target_path)){
                //success
                //save to database

                //parent::create();
                $this->errors[] = "save from here: {$target_path}, pID: {$this->project_id}, loc: {$this->proj_file_loc}";
                // PUT BACK unset($this->temp_path);
                return false;
            }else{
                //failure
               $this->errors[] = "The file upload failed.";
                return false;
            }
        }
    }

    public function destroy(){
        //clean database
        if(parent::delete()){
            //remove file
            $target_path = SITE_ROOT.DS.$this->image_path();
            return unlink($target_path) ? true : false;
        }else{
            //database delete failed
            return false;
        }

    }

}
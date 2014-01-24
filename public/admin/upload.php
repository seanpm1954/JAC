<?php
require_once "../../includes/initialize.php";

if(!$session->is_logged_in() || !$session->access==1){
    $session->message("You must login and be an admin to access this page");
    redirect_to("../login.php");
}
?>
<?php
$max_file_size = 1048576;

if(isset($_POST['submit'])){
    $filename = basename($_FILES['file_upload']['name']);
    $ext = substr($filename, strrpos($filename, '.') + 1);
    if($ext == "pdf"){
        $upload = new ProjectFiles();
        $upload->attach_file($_FILES['file_upload']);
        if($upload->save()){
            $message=("Document was successfully uploaded");
            $session->message($message);
            redirect_to('project.php');
        }else{
            $message= join("<br/>", $upload->errors);
            $session->message($message);
            redirect_to('project.php');
        }
    }else{
       $message=("<b><font color='red'>Document must be a PDF</font></b>");
        $session->message($message);
        redirect_to('project.php');
    }


}
?>
<?php include_layout_template('admin_header.php'); ?>

    <h2>File Upload</h2>
<?php echo output_message($message);
if(isset($_GET['id'])){
    $cID=$_GET['id'];
    $comp = $_GET['company'];
    //$proj = $_GET['proj'];
}else{
   $cID="";
    $comp="";
    //$proj="";
}

?>

<!--    add project_id-->
<!--    add proj_file_loc-->
<!--    get comp_name for directory-->

    <form class="upload1" action="upload.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="50000000" />
        <p><input class="submit3" type="file" name="file_upload" /></p>
        <p><input type="hidden" name="project_id" <?php echo 'value="'.$cID.'"' ?> /></p>
        <p><input type="hidden" name="proj_file_loc" <?php echo 'value="'.$comp.'"' ?> /></p>
<!--        <p><input type="hidden" name="proj" --><?php //echo 'value="'.$proj.'"' ?><!-- placeholder="loc" /></p>-->
        <input class="submit3" type="submit" name="submit" value="Upload" />

    </form>


<?php include_layout_template('admin_footer.php'); ?>
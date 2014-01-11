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
    $upload = new ProjectFiles();
    $upload->attach_file($_FILES['file_upload']);
    if($upload->save()){
       $session->message("Document was successfully uploaded");
        redirect_to('file_upload.php');
    }else{
        $message= join("<br/>", $upload->errors);
    }

}
?>
<?php include_layout_template('admin_header.php'); ?>

    <h2>File Upload</h2>
<?php echo output_message($message); ?>

<!--    add project_id-->
<!--    add proj_file_loc-->
<!--    get comp_name for directory-->

    <form action="file_upload.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
        <p><input type="file" name="file_upload" /></p>
        <input type="submit" name="submit" value="Upload" />

    </form>


<?php include_layout_template('admin_footer.php'); ?>
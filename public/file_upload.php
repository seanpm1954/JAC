<?php
require_once "../includes/initialize.php";

if(!$session->is_logged_in()){ redirect_to("login.php");}
?>
<?php
$max_file_size = 1048576;

if(isset($_POST['submit'])){
    $upload = new ProjectFiles();
    $upload->attach_file($_FILES['file_upload']);
    if($upload->save()){
        $session->message("Document was successfully uploaded");
        redirect_to('view_photos.php');
    }else{
        $message= join("<br/>", $upload->errors);
    }

}
?>
<?php include_layout_template('header.php'); ?>

    <h2>Photo Upload</h2>
<?php echo output_message($message); ?>

    <form action="file_upload.php" enctype="multipart/form-data" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
        <p><input type="file" name="file_upload" /></p>
        <p>Caption: <input type="text" name="caption" value="" /> </p>
        <input type="submit" name="submit" value="Upload" />

    </form>


<?php include_layout_template('footer.php'); ?>
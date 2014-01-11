<?php
require_once "../../includes/initialize.php";
if(!$session->is_logged_in()){ redirect_to("login.php");}

if(empty($_GET['id'])){
    $session->message("No Photograph ID was provided.");
    redirect_to('index.php');
}

$photo = Photograph::find_by_id($_GET['id']);
if($photo && $photo->destroy()){
    $session->message("The photo {$photo->filename} was deleted.");
    redirect_to('view_photos.php');
}else{
    $session->message("The photo could not be deleted.");

    redirect_to('view_photos.php');
}
?>
<?php if(isset($db)){ $db->close_connection(); } ?>
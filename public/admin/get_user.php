<?php require_once "../../includes/initialize.php";

if(!$session->is_logged_in() || !$session->access==1){
    $session->message("You must login and be an admin to access this page");
    redirect_to("../login.php");
}
?>

<?php
if(!empty($_GET["id"])){
    $comp_id = $_GET['id'];
    $user = new User();
    $users= $user->get_details($comp_id);
}
if(isset($db)){ $db->close_connection(); }
?>






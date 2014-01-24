<?php require_once "../../includes/initialize.php";

if(!$session->is_logged_in() || !$session->access==1){
    $session->message("You must login and be an admin to access this page");
    redirect_to("../login.php");
}
?>

<?php
if(!empty($_GET["id"])){
    $user_id = $_GET['id'];
        User::deleteUser($user_id);
        $session->message("User deleted");
}else{
    $session->message("User not deleted");
    //redirect_to('user.php');
}
if(isset($db)){ $db->close_connection(); }
?>






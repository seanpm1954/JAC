<?php
require_once "../../includes/initialize.php";

if(!$session->is_logged_in() || !$session->access==1){
    $session->message("You must login and be an admin to access this page");
    redirect_to("../login.php");
}
?>
<?php
 if(!empty($_POST['submit'])&& !empty($_POST['comp_id'])){
    $comp_id = $_POST['comp_id'];
    $new_first = $_POST['newFirst'];
    $new_userName = $_POST['newUsername'];
    $new_last = $_POST['newLast'];
    $new_email = $_POST['newEmail'];
    $new_pwd = $_POST['newPassword'];
    if(User::saveName($comp_id,$new_userName,$new_pwd,$new_first,$new_last,$new_email)){

        $session->message($_POST['newFirst'." added."]);
        redirect_to('user.php');
    }else{
        $session->message($_POST['newFirst'." was not added."]);
        redirect_to('user.php');
    }

}
if(isset($db)){ $db->close_connection(); }
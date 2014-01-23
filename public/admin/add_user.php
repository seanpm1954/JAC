<?php
require_once "../../includes/initialize.php";

if(!$session->is_logged_in() || !$session->access==1){
    $session->message("You must login and be an admin to access this page");
    redirect_to("../login.php");
}
?>
<?php
if(!empty($_POST['submit']) && !empty($_POST['u_id'])){
    $comp_id = $_POST['u_id'];
    $new_first = $_POST['newFirst'];
    $new_userName = $_POST['newUsername'];
    $new_last = $_POST['newLast'];
    $new_email = $_POST['newEmail'];
    $new_pwd = $_POST['newPassword'];

    if(User::updateName1($comp_id,$new_userName,$new_pwd,$new_first,$new_last,$new_email)){
        $session->message("name change successful.");
        redirect_to('user.php');
    }else{
        $session->message("name change UNSUCCESSFUL !");
        redirect_to('user.php');
    }


}else if(!empty($_POST['submit1'])){


    if(User::saveName($_POST['newFirst'])){

        $session->message($_POST['newFirst'." added."]);
        redirect_to('user.php');
    }else{
        $session->message($_POST['newFirst'." was not added."]);
        redirect_to('user.php');
    }

}else{
    $session->message("name cannot be blank");
    redirect_to('user.php');
}
if(isset($db)){ $db->close_connection(); }
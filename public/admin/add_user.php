<?php
require_once "../../includes/initialize.php";

if(!$session->is_logged_in() || !$session->access==1){
    $session->message("You must login and be an admin to access this page");
    redirect_to("../login.php");
}
?>
<?php
if(!empty($_POST['submit']) && !empty($_POST['u_id'])&& !empty($_POST['company_name'])){
    $comp_name = $_POST['company_name'];
    $comp_id = $_POST['u_id'];
    $new_name = $_POST['newFirst'];

    if(User::updateName1($comp_id,$new_name)){
        $session->message("name change successful.");
        redirect_to('user.php');
    }else{
        $session->message("name change UNSUCCESSFUL !");
        redirect_to('user.php');
    }


}else if(!empty($_POST['submit1']) && !empty($_POST["newFirst"])){


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
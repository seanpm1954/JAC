<?php require_once "../../includes/initialize.php";

if(!$session->is_logged_in() || !$session->access==1){
    $session->message("You must login and be an admin to access this page");
    redirect_to("../login.php");
}
?>

<?php
if(!empty($_GET["company_id"])){
    $comp_id = $_GET['company_id'];
    $session->message("name change successful.");

    $user = new User();
    $users= $user->find_Names($comp_id);


}else{
    $session->message("Company name cannot be blank");
    //redirect_to('company.php');
}
if(isset($db)){ $db->close_connection(); }
?>






<?php require_once "../../includes/initialize.php";

if(!$session->is_logged_in() || !$session->access==1){
    $session->message("You must login and be an admin to access this page");
    redirect_to("../login.php");
}
?>
<?php include_layout_template('admin_header.php'); ?>
<br/><br/>
<?php
if(!empty($_POST['submit']) && !empty($_POST["newComp"])&& !empty($_POST["company_name"])){
    $comp_name = $_POST['company_name'];
    $comp_id = $_POST['comp_id'];
    $new_name = $_POST['newComp'];

    if(Company::updateName($comp_id,$new_name)){
        $session->message("name change successful.");
        redirect_to('company.php');
    }else{
        $session->message("name change UNSUCCESSFUL !");
        redirect_to('company.php');
    }


}else if(!empty($_POST['submit1']) && !empty($_POST["newComp"])){
    $session->message("Name cannot be blank !");
    redirect_to('company.php');
    exit();
}else{
    redirect_to('company.php');
    $session->message("Name cannot be blank1 !");
    exit();
};

?>
<?php echo output_message($message); ?>
<?php if(isset($db)){ $db->close_connection(); } ?>

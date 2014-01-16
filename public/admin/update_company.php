<?php
require_once "../../includes/initialize.php";

if(!$session->is_logged_in() || !$session->access==1){
    $session->message("You must login and be an admin to access this page");
    redirect_to("../login.php");
}
?>

<?php
$action = $_GET['action'];
$company_id = $_GET['id'];


if(empty($company_id)){
        $session->message("No Company ID was provided.");
        //redirect_to('company.php');
}else{
    //$session->message("Company ID: ".$_GET['id']." Action: ".$_GET['action']);

    if($action=='edit'){
        $session->message("Company ID: {$company_id}, Action(edit): {$action}");
    }else{
        $session->message("Company ID: {$company_id}, Action(delete): {$action}");
    }
    //redirect_to('company.php');
}
?>
<?php include_layout_template('admin_header.php'); ?>
   <?php if($action =='add'){
    $session->message("Company ID: {$company_id}, Action(add): {$action}");
    $coName="";
?>
<br/><br/>
<form action="add_company.php" method="post">


		      <p><B>New Company Name:</B></p>
    <?php echo output_message($message); ?>
		        <input type="text" name="coName" maxlength="30" value="<?php echo htmlentities($coName); ?>" />

		        <input type="submit" name="submit" value="Add New" />

		</form>
<?php } ?>
		</div>
	<?php include_layout_template('admin_footer.php'); ?>
<?php if(isset($db)){ $db->close_connection(); } ?>
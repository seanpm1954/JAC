<?php
require_once "../../includes/initialize.php";

if(!$session->is_logged_in() || !$session->access==1){
    $session->message("You must login and be an admin to access this page");
    redirect_to("../login.php");
}
?>

<?php include_layout_template('admin_header.php'); ?>

		</div>
	<?php include_layout_template('admin_footer.php'); ?>
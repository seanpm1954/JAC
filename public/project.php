<?php
require_once "../includes/initialize.php";

if(!$session->is_logged_in()){
    $session->message("You must login to access this page");
    redirect_to("login.php");}
?>
<?php include_layout_template('header.php'); ?>

		</div>
	<?php include_layout_template('footer.php'); ?>

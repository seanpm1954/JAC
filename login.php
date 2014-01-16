<?php
require_once("includes/initialize.php");

if($session->is_logged_in() ) {
    if($session->access==0){
        redirect_to('public/admin/index.php');
    }else{
        redirect_to('public/index.php');
    }

}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.

  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  
  // Check database to see if username/password exist.
	$found_user = User::authenticate($username, $password);
//	echo "<pre>";
//    print_r($found_user);
//    echo "<pre>";
  if ($found_user) {
      if($found_user->active ==1){
          $session->message("This user has been marked as inactive.");
          $messageTxt="";
          $messageTxt .= "**INACTIVE USER**: {$username} tried to log in at ".strftime('%m/%d/%Y %H:%M', time());
          log_action($action,$messageTxt);
          redirect_to("logout.php");
      }elseif($found_user->access==1){
              $session->login($found_user);
              $action = "login";
              $messageTxt="";
              $messageTxt .= "Admin: {$username} logged in at ".strftime('%m/%d/%Y %H:%M', time());
              log_action($action,$messageTxt);
              $_SESSION['cName'] = Company::get_cName($found_user->company_id);
              redirect_to("public/admin/index.php");
      }elseif($found_user->access==2){
              $session->login($found_user);
              $action = "login";
              $messageTxt="";
              $messageTxt .= "User: {$username} logged in at ".strftime('%m/%d/%Y %H:%M', time());
              log_action($action,$messageTxt);
              $_SESSION['cName'] = Company::get_cName($found_user->company_id);
              $_SESSION['cID'] = $found_user->company_id;
              redirect_to("public/index.php");
      }else{
          $session->message("access: ".$found_user->access);
      }

      } else {
      if(!isset($username)){$username = "not provided";};
      if(!isset($password)){$password = "not provided";};
      $action = "login";
      $messageTxt="";
      $messageTxt .= "User: {$username}, using {$password} tried unsuccessfully to login in at ".strftime('%m/%d/%Y %H:%M:%S', time());
      log_action($action,$messageTxt);
      $session->message("Username/password combination incorrect.");
  }
  }else { // Form has not been submitted.
    $username = "";
    $password = "";
}



?>
<?php include_layout_template('headerLogin.php'); ?>
		<?php echo output_message($message);
            echo "<br/>Logged in from: ".$_SERVER['REMOTE_ADDR'];
        ?>
        <br/>
		<form action="login.php" method="post">
		  <table>
		    <tr>
		      <td>Username:</td>
		      <td>
		        <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
		      </td>
		    </tr>
		    <tr>
		      <td>Password:</td>
		      <td>
		        <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
		      </td>
		    </tr>
		    <tr>
		      <td colspan="2">
		        <input type="submit" name="submit" value="Login" />
		      </td>
		    </tr>
		  </table>
		</form>
    <?php include_layout_template('footer.php'); ?>
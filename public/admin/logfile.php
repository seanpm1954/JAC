<?php
require_once "../../includes/initialize.php";

if(!$session->is_logged_in() || !$session->access==1){
    $session->message("You must login and be an admin to access this page");
    redirect_to("../login.php");
}
?>
<?php
$logfile=SITE_ROOT.DS."logs".DS.'logfile.txt';
if(isset($_GET['clear'])){
    if($_GET['clear']=='true'){
        file_put_contents($logfile, '');
        log_action('Logs Cleared', "by userID {$session->user_id}");
        redirect_to('logfile.php');

    }
}
?>
<?php include_layout_template('admin_header.php'); ?>
<br/>
<h2>Log Files</h2>

<p><a href="logfile.php?clear=true">Clear log file</a></p>

<?php
if(file_exists($logfile) && is_readable($logfile) && $handle = fopen($logfile, 'r')){
    echo "<ul class=\"log-entries\">";
    while(!feof($handle)){
        $entry = fgets($handle);
        if(trim($entry) !=""){//chk for newline without content..
           echo "<li>{$entry}</li>";
        }
    }
    echo "</ul>";
    fclose($handle);
}else{
    echo "Could not reed from {$logfile}.";
}
?>
</div>
<?php include_layout_template('admin_footer.php'); ?>

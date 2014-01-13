<?php
require_once "../includes/initialize.php";

if(!$session->is_logged_in()){
    $session->message("You must be logged to access this page");
    redirect_to("../login.php");
}
?>
<?php
$projects = Project::find_all();
$project_files= ProjectFiles::find_all();
$up_dir = SITE_ROOT.DS."uploads".DS;
$comp=$_SESSION['cName'];
$cID =$_SESSION['cID'];

?>
<?php include_layout_template('header.php'); ?>

    <h2>File Upload</h2>
    <h3>Select project to upload to:</h3>
<?php echo output_message($message); ?>
    <ul>

            <?php echo "<li><b>".$comp."</b></li>"; ?>

            <?php foreach($projects as $project): ?>
                <?php if($project->company_id == $cID){ ?>
                    <?php echo "<ul>"; ?>
                    <?php $comp1= $comp; ?>
                    <?php $comp1=preg_replace('/[^A-Za-z0-9]/', "",$comp1) ?>
                    <!--                    --><?php //$proj= $project->project_name ?>
                    <!--                    --><?php //$proj=preg_replace('/[^A-Za-z0-9]/', "",$proj) ?>
                    <?php echo "<li><a href=upload.php?id={$project->id}&company={$comp1}>".$project->project_name."</a></li>"; ?>
                    <?php echo "</ul>"; ?>
                <?php }  endforeach; ?>


    </ul>

<?php include_layout_template('footer.php'); ?>
<?php
require_once "../../includes/initialize.php";

if(!$session->is_logged_in() || !$session->access==1){
    $session->message("You must login and be an admin to access this page");
    redirect_to("../login.php");
}
?>
<?php
$companies= Company::find_all();
$projects = Project::find_all();
?>
<?php include_layout_template('admin_header.php'); ?>

    <h2>File Upload</h2>
    <h3>Select project to upload to:</h3>
<?php echo output_message($message); ?>
    <ul>
        <?php foreach($companies as $company): ?>
            <?php echo "<li><b>".$company->company_name."</b></li>"; ?>

            <?php foreach($projects as $project): ?>
                <?php if($project->company_id == $company->id){ ?>
                    <?php echo "<ul>"; ?>
                    <?php $comp1= $company->company_name ?>
                    <?php $comp1=preg_replace('/[^A-Za-z0-9]/', "",$comp1) ?>
<!--                    --><?php //$proj= $project->project_name ?>
<!--                    --><?php //$proj=preg_replace('/[^A-Za-z0-9]/', "",$proj) ?>
                    <?php echo "<li><a href=upload.php?id={$project->id}&company={$comp1}>".$project->project_name."</a></li>"; ?>
                    <?php echo "</ul>"; ?>
                <?php }  endforeach; ?>

        <?php endforeach; ?>
    </ul>

<?php include_layout_template('admin_footer.php'); ?>
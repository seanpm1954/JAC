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
$project_files= ProjectFiles::find_all();
$up_dir = SITE_ROOT.DS."uploads".DS;
$comp="";
?>

<?php include_layout_template('admin_header.php'); ?>

    <h2>Projects</h2>
<?php echo output_message($message); ?>
    <ul>
        <?php foreach($companies as $company): ?>
            <?php echo "<li><b>".$company->company_name."</b></li>"; ?>
            <?php $comp= $company->company_name ?>
            <?php $comp=preg_replace('/[^A-Za-z0-9]/', "",$comp) ?>
                <?php foreach($projects as $project): ?>
                    <?php if($project->company_id == $company->id){ ?>
                        <?php echo "<ul>"; ?>
                        <?php echo "<li>".$project->project_name."</li>"; ?>
                    <?php echo "<ul>"; ?>
                        <?php foreach($project_files as $pfile): ?>
                           <?php if($pfile->project_id == $project->id){ ?>
        <?php echo "<li><a href=\"../../uploads/$comp/{$pfile->proj_file_loc}\" target=\"_blank\">".$pfile->proj_file_loc."</a></li>"?>
                        <?php }  endforeach; ?>
                    <?php echo "</ul>"; ?>
                    <?php echo "</ul>"; ?>
                 <?php }  endforeach; ?>

        <?php endforeach; ?>
    </ul>


		</div>
	 <?php include_layout_template('admin_footer.php'); ?>
<?php if(isset($db)){ $db->close_connection(); } ?>
<!--chk user lgged in for downloads-->
<!--$name = 'MyPDF.pdf';-->
<!--$filename = 'data/pdf_12345.pdf';-->
<!--header('Content-Disposition: attachment; filename="'.$name.'"');-->
<!--header("Content-Type: application/pdf");-->
<!--header("Content-Length: " . filesize($file));-->
<!--fpassthru($filename)-->
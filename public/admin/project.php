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
<script type="text/javascript" src="../js/jquery-1.10.2.js" xmlns="http://www.w3.org/1999/html"></script>

<script type="text/javascript">
 $(document).ready(function(){
     var theID = '';
     var theProject ="";
     $('.submit1').on('click', function(){
         //delete user
//         var $compID = $("#editComp :selected").val();
//         alert($compID);
         $("#addProject").removeAttr("hidden");
         $("#projects").attr("hidden","true");
         $("#submit1").attr("hidden","true");

//             $.ajax({
//                 type: "GET",
//                 url: "deleteUser.php",
//                 data: "id="+ $userID,
//                 success: function(data){
//                     window.location.href = 'user.php';
//                 }
//             });


     });

     $('.editComp').on('click', function(){
         $("#projectName").removeAttr("hidden");
         var $compID = $("#id :selected").val();
         $('#comp_id').val($compID);


     });


});
</script>


<?php include_layout_template('admin_header.php'); ?>

    <h2>Projects</h2>
<?php echo output_message($message); ?>
<input name="submit1" class="submit1" id="submit1" type='submit' value='Add new project' />
<form id="projects">

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

</form>

<form action="add_project.php" id="addProject" hidden="hidden" method="post">
    <?php
    echo '<select size="10" id="id" class="editComp">';

    foreach ($companies as $company){

        echo '<option value="'.$company->id.'">'.$company->company_name.'</option>';

    }

    echo '</select>';
    ?>
    <input type="hidden" name="comp_id" id="comp_id">
    <span id="spryProjectName"><input type="text" name="projectName" id="projectName" placeholder="Project name" hidden="hidden">
                    <span class="textfieldRequiredMsg">A Project name is required.</span></span>
    <input name="submit2" class="submit2" id="submit2" type='submit' value='Add new project' />
    <input type="button" class="cancel" name="cancel" value="cancel" onClick="window.location='project.php';" />
</form>

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
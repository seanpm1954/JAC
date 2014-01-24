<?php
require_once "../../includes/initialize.php";

if(!$session->is_logged_in() || !$session->access==1){
    $session->message("You must login and be an admin to access this page");
    redirect_to("../login.php");
}
?>
<?php
if(!empty($_POST['comp_id'])){
    $comp_id = $_POST['comp_id'];
    $proj_name = $_POST['projectName'];

    if(Project::saveProject($comp_id,$proj_name)){
        $session->message($proj_name." added.");
        redirect_to('project.php');
    }else{
        $session->message("There was a problem saving the project");
        redirect_to('project.php');
    }



}else{
    $session->message(" NOT added.");
    redirect_to('project.php');
}
if(isset($db)){ $db->close_connection(); }
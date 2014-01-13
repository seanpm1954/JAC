<?php require_once "../../includes/initialize.php";

if(!$session->is_logged_in() || !$session->access==1){
$session->message("You must login and be an admin to access this page");
redirect_to("../login.php");
}
?>
<?php
if($_POST['submit'] && !empty($_POST['coName'])){
$comp1= $_POST['coName'];
$comp1=preg_replace('/[^A-Za-z0-9]/', "",$comp1);

    if(Company::saveName($_POST['coName'])){
        $newDir = SITE_ROOT.DS."uploads".DS.$comp1;
        $chkDir = is_dir($newDir);
        if($chkDir == false){
            mkdir($newDir,0777);
            chmod($newDir, 0777);
        }
        $session->message($_POST['coName'." added."]);
        redirect_to('company.php');
    }else{
        $session->message($_POST['coName'." was not added."]);
        redirect_to('company.php');
    }

}else{
    $session->message("Company name cannot be blank");
    redirect_to('update_company.php?id=0&action=add');
}
?>
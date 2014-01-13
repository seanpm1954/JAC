<?php
require_once "../../includes/initialize.php";

if(!$session->is_logged_in() || !$session->access==1){
    $session->message("You must login and be an admin to access this page");
    redirect_to("../login.php");
}
?>

<?php
if(isset($_GET['clear'])){
    if($_GET['clear']=='true'){
        redirect_to('company.php');
    }
}
?>
<?php
$companies = Company::find_all();
?>
<?php include_layout_template('admin_header.php'); ?>
     <h2>Companies</h2>
<?php echo output_message($message); ?>


<table class="bordered">
    <tbody>
    <th>Company</th>
    <?php echo "<th><a href=update_company.php?id=0&action=add&clear='true' ?>"."Add New "."</a></th>"?>
    </tbody>
<?php foreach($companies as $company): ?>
    <?php echo "<tr><td><b>".$company->company_name."</b></td>"; ?>

    <?php echo "<td><img src='../images/spacer1.png'><a href='#'><a href=update_company.php?id={$company->id}&action=edit&clear='true' ?>"."Edit"."</a><img src='../images/spacer1.png'></td>"?>
    <?php echo "<td><a href=update_company.php?id={$company->id}&action=del&clear='true' ?>"."Delete"."</a><img src='../images/spacer1.png'></td>"?>
    <?php endforeach ?>

</table>

<!--FOR ADDING CO-->
<?php //$comp1= $company->company_name ?>
<?php //$comp1=preg_replace('/[^A-Za-z0-9]/', "",$comp1) ?>
<br/>

</div>

<?php include_layout_template('admin_footer.php'); ?>
<?php if(isset($db)){ $db->close_connection(); } ?>
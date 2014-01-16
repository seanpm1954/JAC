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
    <script type="text/javascript" src="../js/jquery-1.10.2.js"></script>

<?php include_layout_template('admin_header.php'); ?>
    <script type="text/javascript">
        $(document).ready(function(){

            var mTxt ='';
            $('.editComp').on('click', function(){
                mTxt = $("#id :selected").text();
                var mID = $("#id :selected").val();
                $('#company_name').val(mTxt);
                $('#comp_id').val(mID);
            });

            $(function () {
                $("#newComp").bind("change keyup",
                    function () {
                        if ($("#company_name").val() != "" && $("#newComp").val() != ""){
                            $("#submit").removeAttr("disabled");

                        }else if ( $("#newComp").val() != ""){
                            //console.log('new');
                            $("#submit1").removeAttr("disabled");
                        }
                    });
            });

        });



    </script>
     <h2>Companies</h2>
<?php echo output_message($message); ?>

<?php
echo '<select size="10" id="id" class="editComp">';
foreach ($companies as $company){

    echo '<option value="'.$company->id.'">'.$company->company_name.'</option>';
}

echo '</select>';
?>

    <form  id="fComp" action="edit_company.php" method="post">
        <div class="textInput">
            <div class="primary">
                <label for="company_name">Change :</label>
                <input type="text" name="company_name" id="company_name" readonly>
                <input type="hidden" name="comp_id" id="comp_id" >

                <div class="secondary">
                    <label for="newComp">To :</label>
                    <input type="text" name="newComp" id="newComp" placeholder="New Name">
                    <input name="submit" class="submit" id="submit" type='submit' value='Edit' disabled="disabled"/>
                    <input name="submit1" class="submit1" id="submit1" type='submit' value='Add' disabled="disabled"/>
                    <input type="button" class="cancel" name="cancel" value="cancel" onClick="window.location='company.php';" />
                </div>
            </div>
        </div>
    </form>
</div>

<?php include_layout_template('admin_footer.php'); ?>
<?php if(isset($db)){ $db->close_connection(); } ?>
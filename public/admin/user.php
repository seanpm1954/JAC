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
        redirect_to('user.php');
    }
}
?>
<?php
$companies = Company::find_all();
$users = User::find_all();
?>
    <script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
<?php include_layout_template('admin_header.php'); ?>
    <script type="text/javascript">
        $(document).ready(function(){

            var mTxt ='';
            var mTxtID ='';
            var mTxtName ='';
            var items='';
            $('.editComp').on('click', function(){
                mTxt = $("#id :selected").text();
               var mID = $("#id :selected").val();

                $('#comp_id').val(mID);
                $.ajax({
                    type: "GET",
                    url: "edit_user.php",
                    data: "company_id="+ mID,
                    success: function(html){
                       // $('#company_name').val(html);
                        $("#user_id").html(html);
                }
                });
            });

            $('.user_id').on('click', function(){
                mTxtID = $("#user_id :selected").val();
                mTxtName = $("#user_id :selected").text();
                $('#u_id').val(mTxtID);
                $('#company_name').val(mTxtName);

                //get all user fields here

                $.ajax({
                    type: "GET",
                    url: "add_user.php",
                    data: "id="+ mTxtID
                });

            });

            $(function () {
                $("#newFirst").bind("change keyup",
                    function () {
                        if ($("#company_name").val() != "" && $("#newFirst").val() != ""){
                            $("#submit").removeAttr("disabled");

                        }else if ( $("#newFirst").val() != ""){
                            //console.log('new');
                            $("#submit1").removeAttr("disabled");
                        }
                    });
            });


        });



    </script>
     <h2>Select Company</h2>
<?php echo output_message($message); ?>

<?php
echo '<select size="10" id="id" class="editComp">';

foreach ($companies as $company){

    echo '<option value="'.$company->id.'">'.$company->company_name.'</option>';

}

echo '</select>';
echo '<select size="10" id="user_id" class="user_id">';
echo '</select>';


?>

    <form  id="fComp" action="add_user.php" method="post">
        <div class="textInput">
            <div class="primary">
                <label for="company_name">Change :</label>
                <input type="text" name="company_name" id="company_name" readonly>
                <input type="hidden" name="comp_id" id="comp_id" >
                <input type="hidden" name="u_id" id="u_id" >

                <div class="secondary">
                    <label for="newComp">To :</label>
                    <input type="text" name="newUsername" id="newUsername" placeholder="New Username">
                    <input type="text" name="newPassword" id="newPassword" placeholder="New Password">
                    <input type="text" name="newFirst" id="newFirst" placeholder="New First">
                    <input type="text" name="newLast" id="newLast" placeholder="New Last">
                    <input type="text" name="newEmail" id="newEmail" placeholder="New Email"><br/>
                    <input name="submit" class="submit" id="submit" type='submit' value='Edit' disabled="disabled"/>
                    <input name="submit1" class="submit1" id="submit1" type='submit' value='Add' disabled="disabled"/>
                    <input type="button" class="cancel" name="cancel" value="cancel" onClick="window.location='user.php';" />
                </div>
            </div>
        </div>
    </form>
</div>

<?php include_layout_template('admin_footer.php'); ?>
<?php if(isset($db)){ $db->close_connection(); } ?>
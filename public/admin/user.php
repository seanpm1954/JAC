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
    <script type="text/javascript" src="../js/jquery-1.10.2.js" xmlns="http://www.w3.org/1999/html"></script>
<?php include_layout_template('admin_header.php'); ?>
    <script type="text/javascript">
        $(document).ready(function(){


            $('.submit2').on('click', function(){
                //delete user
            var $userID = $("#user_id :selected").val();
                var $username = $("#user_id :selected").text();
                var $answer = confirm ("Delete " + $username + "? This cannot be undone!");
                if ($answer)
                {
                    $.ajax({
                    type: "GET",
                    url: "deleteUser.php",
                    data: "id="+ $userID,
                    success: function(data){
                        window.location.href = 'user.php';
                    }
                });

                }else{
                    window.location.href = 'user.php';
                }

            });

            var mTxt ='';
            var mTxtID ='';
            var mTxtName ='';
            var items='';
            $('.editComp').on('click', function(){
                mTxt = $("#id :selected").text();
               var mID = $("#id :selected").val();
                $('#newUsername').val("");
                $('#newPassword').val("");
                $('#newFirst').val("");
                $('#newLast').val("");
                $('#newEmail').val("");
                $('#comp_id').val(mID);
                $("#fComp").removeAttr("hidden");
                $("#fComp1").attr("hidden","true");
                $("#deleteUser").attr("hidden","true");
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
                $("#deleteUser").removeAttr("hidden");
                $("#fComp1").removeAttr("hidden");
                $("#fComp").attr("hidden","true");
                $('#u_id').val(mTxtID);
                $('#company_name').val(mTxtName);


                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "get_user.php",
                    data: {id: mTxtID},
                    success: function(data){
                        //alert(serverResponse);
                        $('#newUsername').val(data[0].username);
                        $('#newPassword').val(data[0].password);
                        $('#newFirst').val(data[0].first_name);
                        $('#newLast').val(data[0].last_name);
                        $('#newEmail').val(data[0].email);
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
<!--edit user-->
<form  id="fComp1" action="add_user.php" method="post" hidden="hidden">
        <div class="textInput">
            <div class="secondary">
<!--                delete user-->
                <form  id="deleteUser" method="get" hidden="hidden">
                    <input name="submitDel" class="submit2" id="submitDel" type='button' value='Delete this user' />
                    <br/>
                </form>
<!--                end delete user-->
               <label for="company_name">Change :</label>
                <input type="hidden" name="company_name" id="company_name1" readonly>
                <input type="hidden" name="comp_id" id="comp_id1" >
                <input type="hidden" name="u_id" id="u_id1" >


<!--                <div class="secondary">-->
                    <label for="newUsername">Username :</label>
                    <span id="spryUserName1"><input type="text" name="newUsername" id="newUsername" placeholder="New Username">
                    <span class="textfieldRequiredMsg">A value is required.</span></span>
                    <label for="newPassword">Password :</label>
                    <input type="text" name="newPassword" id="newPassword" placeholder="New Password">
                    <label for="newFirst">First :</label>
                    <input type="text" name="newFirst" id="newFirst" placeholder="New First">
                    <label for="newLast">Last :</label>
                    <input type="text" name="newLast" id="newLast" placeholder="New Last">
                    <label for="newEmail">Email :</label>
                    <input type="text" name="newEmail" id="newEmail" placeholder="New Email">
                    <br/><br/>
                    <input name="submit" class="submit" id="submit" type='submit' value='Edit' />
                    <input type="button" class="cancel" name="cancel" value="cancel" onClick="window.location='user.php';" />

<!--                </div>-->
                </div>
            </div>

    </form>

<!--Form to Add new-->
    <form  id="fComp" action="add_user1.php" method="post" hidden="hidden">
        <div class="textInput">
            <div class="secondary">
                <label for="company_name">Add :</label>
                <input type="hidden" name="company_name" id="company_name" readonly>
                <input type="hidden" name="comp_id" id="comp_id" >
                <input type="hidden" name="u_id" id="u_id" >
                <br/>

                <!--                <div class="secondary">-->
                <label for="newUsername">Username :</label>
                    <span id="spryUserName"><input type="text" name="newUsername" id="newUsername" placeholder="New Username">
                    <span class="textfieldRequiredMsg">A usename is required.</span></span>
                <span id="spryPassword"><label for="newPassword">Password :</label>
                <input type="text" name="newPassword" id="newPassword" placeholder="New Password"><span class="textfieldRequiredMsg">A password is required.</span></span>
                <label for="newFirst">First :</label>
                <span id="spryFirst"><input type="text" name="newFirst" id="newFirst" placeholder="New First"><span class="textfieldRequiredMsg">A First Name is required.</span></span>
                <label for="newLast">Last :</label>
                <span id="spryLast"><input type="text" name="newLast" id="newLast" placeholder="New Last"><span class="textfieldRequiredMsg">A Last Name is required.</span></span>
                <label for="newEmail">Email :</label>
                <span id="spryEmail"><input type="text" name="newEmail" id="newEmail" placeholder="New Email"><span class="textfieldRequiredMsg">An Email is required.</span></span>
                <br/><br/>
                <input name="submit" class="submit" id="submit" type='submit' value='Add' />
                <input type="button" class="cancel" name="cancel" value="cancel" onClick="window.location='user.php';" />

                <!--                </div>-->
            </div>
        </div>

    </form>

    <div id="output" align="center">
</div>

<?php include_layout_template('admin_footer.php'); ?>
<?php if(isset($db)){ $db->close_connection(); } ?>
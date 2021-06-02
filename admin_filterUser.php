<?php require_once('inc/connection.php'); ?>
<?php
$msg_error = false;
$msg_sucess = false;

//check if the button clicked
if(isset($_POST['submit'])){
    //sanitize the variables
    $filter_userStatus=$_POST['submit'];

    //prepare selec query for get user details from user table
    $select_query = "SELECT * FROM tbluser WHERE userStatus='$filter_userStatus'";
    $exc_select_query = mysqli_query($connection,$select_query);
    $rowCount = mysqli_num_rows($exc_select_query);

    //if query success
    if($rowCount!=0){
        

        //cerate user details table
        $table = '<table id="tblUserListTopic" class="table table-striped table-info" style="font-size:12px;">';
        $table .= '<thead class=""><tr class="bg-info text-light"><th scope="col" style="display:none;">#</th><th scope="col">Email</th><th scope="col">Profile</th><th scope="col">user Status</th></tr></thead>';
        //check every records one by one using for loop
        for($i=0;$i<$rowCount;$i++){
            $records = mysqli_fetch_assoc($exc_select_query);
            //sanitize variables
            $userId = $records['userId'];
            $email=$records['email'];
            $profetion = $records['userType'];
            $userStatus = $records['userStatus'];
            //asign variabkls to the table
            $table .= '<tbody>';
            $table .= '<tr>';
            $table .= '<td id="tdUserId"  style="display:none;">'.$userId.'</td>';
            $table .= '<td id="tdEmail" ><a href="" class="text-decoration-none text-dark select">'.$email.'</a></td>';
            $table .= '<td id="tdProfetion" >'.$profetion.'</td>';
            $table .= '<td id="tdUserStatus" >'.$userStatus.'</td>';
            $table .= '</tr>';
            $table .= '</tbody>';
        }
        $table .= '</table>';

        echo $table;
    }else{
        echo '<p role="alert" class="alert alert-warning text-center">Thair is no any '.$filter_userStatus.' users.</p>';
    }
}
?>
<script>
    var msg_error = "<?php echo $msg_error;?>";
    var msg_sucess = "<?php echo $msg_sucess;?>";
    
    if(msg_error == true){
        $("#status_msg").addClass("alert alert-danger");
        $("#status_msg").removeClass("alert alert-success");
    }else if(msg_sucess == true){
        $("#status_msg").addClass("alert alert-success");
        $("#status_msg").removeClass("alert alert-danger");
    }
</script>
<script>
    $(document).ready(function(){
       //get selected user details
       $(".select").click(function(event){
            event.preventDefault();
            // find the row
            var row = $(this).closest("tr");
            // Find the user Id
            var userId = row.find("#tdUserId").text();
            var email = row.find("#tdEmail").text();
            //load user details
            $("#div_currentUser").load('admin_selected_userDetails.php',{
                email:email
            });
            //load book barrow details
            $("#div_BarrowDetails").load('admin_selectedUser_barrowDetails.php',{
                email:email
            })
        }); 
    });
</script>
<?php mysqli_close($connection); ?>
<?php session_start(); ?>
<?php
    require_once('inc/connection.php');
    $msg_error = false;
    $msg_sucess = false;

    if(isset($_POST['changePassword'])){
        //view user details
        $userId = $_SESSION['userId'];
        //get passwords
        $currentPassword = mysqli_real_escape_string($connection,$_POST['currentPassword']);
        $newPassword = mysqli_real_escape_string($connection,$_POST['newPassword']);
        $conformNewPassword = mysqli_real_escape_string($connection,$_POST['conformNewPassword']);

        //encoding passwords
        $encoded_currentPassword = base64_encode($currentPassword);
        $encoded_newPassword = base64_encode($newPassword);
        $encoded_conformPassword = base64_encode($conformNewPassword);

        //check if the new passwords are match
        if($newPassword != $conformNewPassword){
            echo '<div role="alert">New password missmatch! please try agan.</div>';
            $msg_error = true;
        }else{
            //prepare select query
            $select_query = "SELECT * FROM tbluser WHERE userId='$userId' LIMIT 1";
            $excute_select_query = mysqli_query($connection,$select_query);

            //get current password from database
            $user = mysqli_fetch_assoc($excute_select_query);
            $currentPassword_databse = $user['password'];
            
            //check user enterd password and password get in database is are semiler
            if($currentPassword_databse == $encoded_currentPassword){
                //prepare update query
                $update_query="UPDATE tbluser SET password = '$encoded_newPassword' WHERE userId='$userId'";
                $excute_update_query= mysqli_query($connection,$update_query);

                //if update query is sucess
                if($excute_update_query){
                    echo '<div role="alert">New password update sucess!</div>';
                    $msg_sucess = true;
                }else{
                    echo '<div role="alert">'.mysqli_error($connection).'</div>';
                    $msg_error = true;
                }
            }else{
                echo '<div role="alert">Current password incorrect! please try agan.</div>';
                $msg_error = true;
            }
            
        }
    }
?>
<script>
    var msg_error = "<?php echo $msg_error;?>";
    var msg_sucess = "<?php echo $msg_sucess;?>";
    
    if(msg_error == true){
        $("#satus_msg").addClass("alert alert-danger");
        $("#satus_msg").removeClass("alert alert-success");
    }else if(msg_sucess == true){
        $("#satus_msg").addClass("alert alert-success");
        $("#satus_msg").removeClass("alert alert-danger");
    }
    
</script>
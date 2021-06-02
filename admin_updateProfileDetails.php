<?php session_start(); ?>
<?php
    require_once('inc/connection.php');
    $msg_error = false;
    $msg_sucess = false;

    //set admin id
    $adminId = $_SESSION['adminId'];
    //create database query for get admin details
    $query = "SELECT * FROM tbladmin WHERE adminId='$adminId'";
    //excute query
    $excute_query = mysqli_query($connection, $query);

    $admin = mysqli_fetch_assoc($excute_query);
    $currentPassword= $admin['password'];

    //check if the update butten clicked
    if(isset($_POST['update'])){
        //set user details;
        $fullName = mysqli_real_escape_string($connection,$_POST['fullName']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $nic = mysqli_real_escape_string($connection,$_POST['nic']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);
        $encoded_password = base64_encode($password);

        //check if the passwords are match
        if($currentPassword == $encoded_password){
            //update query
            $update_query="UPDATE tbladmin SET fullName='$fullName', email='$email', NIC='$nic' WHERE adminId='$adminId' LIMIT 1";
            $excute_update_query = mysqli_query($connection,$update_query);

            //if query sucess
            if($excute_update_query){
                echo 'Update sucess!';
                $msg_sucess = true;
            }
            else{
                echo 'Update failed!';
                $msg_error = true;
                echo (mysqli_error($connection));
            }
        }else{
            echo 'Invalied password! please try agan.';
            $msg_error = true;
        }
    }
?>
<script>
    var msg_error = "<?php echo $msg_error;?>";
    var msg_sucess = "<?php echo $msg_sucess;?>";
    
    if(msg_error == true){
        $("#update_satus_msg").addClass("alert-danger");
        $("#update_satus_msg").removeClass("alert-success");
    }else if(msg_sucess == true){
        $("#update_satus_msg").addClass("alert-success");
        $("#update_satus_msg").removeClass("alert-danger");
    }
</script>
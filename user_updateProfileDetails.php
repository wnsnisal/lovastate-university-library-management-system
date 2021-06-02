<?php session_start(); ?>
<?php
    require_once('inc/connection.php');
    $msg_error = false;
    $msg_sucess = false;

    //set user id
    $userId = $_SESSION['userId'];
    //create database query for get user details
    $query = "SELECT * FROM tbluser WHERE userId='$userId'";
    //excute query
    $excute_query = mysqli_query($connection, $query);

    $user = mysqli_fetch_assoc($excute_query);
    $currentPassword= $user['password'];
    //check if the update butten clicked
    if(isset($_POST['update'])){
        //set user details
        $firstName = mysqli_real_escape_string($connection,$_POST['firstName']);
        $lastName = mysqli_real_escape_string($connection,$_POST['lastName']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $nic = mysqli_real_escape_string($connection,$_POST['nic']);
        $address = mysqli_real_escape_string($connection,$_POST['address']);
        $profection = mysqli_real_escape_string($connection,$_POST['profection']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);
        $encoded_password = base64_encode($password);

        //check if the passwords are match
        if($currentPassword == $encoded_password){
            //update query
            $update_query="UPDATE tbluser SET firstName='$firstName', lastName='$lastName', email='$email', NIC='$nic', AddressOrZip='$address', userType='$profection' WHERE userId='$userId' LIMIT 1";
            $excute_update_query = mysqli_query($connection,$update_query);

            //if query sucess
            if($excute_update_query){
                echo '<div role="alert">Update sucess!</div>';
                $msg_sucess = true;
            }
            else{
                echo '<div role="alert">Update failed!</div>';
                $msg_error = true;
                echo (mysqli_error($connection));
            }
        }else{
            echo '<div role="alert">Invalied password! please try agan.</div>';
            $msg_error = true;
        }
    }
?>
<script>
    var msg_error = "<?php echo $msg_error;?>";
    var msg_sucess = "<?php echo $msg_sucess;?>";
    
    if(msg_error == true){
        $("#update_satus_msg").addClass("alert alert-danger");
        $("#update_satus_msg").removeClass("alert alert-success");
    }else if(msg_sucess == true){
        $("#update_satus_msg").addClass("alert alert-success");
        $("#update_satus_msg").removeClass("alert alert-danger");
    }
</script>
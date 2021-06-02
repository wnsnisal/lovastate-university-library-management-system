<?php
    require_once('inc/connection.php');
    $msg_error = false;
    $msg_sucess = false;
    if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $query = "SELECT * FROM tbluser WHERE email = '{$email}' LIMIT 1";
        $exe_query = mysqli_query($connection, $query);

        if(mysqli_num_rows($exe_query)==1){
            echo '<div role="alert">email is already exist!</div>';
            $msg_error = true;
        }else{
            $firstName = mysqli_real_escape_string($connection,$_POST['firstName']);
            $lastName = mysqli_real_escape_string($connection,$_POST['lastName']);
            $mobileNo = mysqli_real_escape_string($connection,$_POST['mobileNo']);
            $nic = mysqli_real_escape_string($connection,$_POST['nic']);
            $address = mysqli_real_escape_string($connection,$_POST['address']);
            $userType = mysqli_real_escape_string($connection,$_POST['userType']);
            $password = mysqli_real_escape_string($connection,$_POST['password']);
            $userStatus = "Active";
            $encoded_password = base64_encode($password);
            $query = "INSERT INTO tbluser (firstName,lastName,userType,password,email,mobileNo,AddressOrZip,NIC,userStatus) VALUES('$firstName','$lastName','$userType','$encoded_password','$email','$mobileNo','$address','$nic','$userStatus')";
            $excute_query = mysqli_query($connection, $query);

            if($excute_query){
                echo '<div role="alert">your account was created! please login.</div>';
                $msg_sucess = true;
            }else{
                echo '<div role="alert">invalide inputs please try agan!</div>';
                
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
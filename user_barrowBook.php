<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php
    $msg_error = false;
    $msg_sucess = false;
    if(isset($_POST['submit'])){
        //get current user id
        $userId = $_SESSION['userId'];
        //create database query for get user details
        $query = "SELECT * FROM tbluser WHERE userId='$userId'";
        //excute query
        $excute_query = mysqli_query($connection, $query);
        $user = mysqli_fetch_assoc($excute_query);

        $user_email = $user['email'];
        $user_password = $user['password'];

        //get email and password user enterd
        $email = mysqli_real_escape_string($connection,$_POST['conform_email']);
        $password = mysqli_real_escape_string($connection,$_POST['conform_password']);
        $encoded_password = base64_encode($password);

        if($user_email == $email && $user_password == $encoded_password){
            //sanitize the varibales for insert barrowing book details
            $bookId = $_POST['barrow_bookId'];
            $bookName = $_POST['barrow_bookName'];
            $publisher = $_POST['barrow_publisher'];
            $discription = $_POST['barrow_discription'];
            $category = $_POST['barrow_category'];

            $issueDate = date("Y/m/d");
            $returnDate= date("Y/m/d", strtotime('+14 days'));

            //insert query for add barrow details
            $insert_query = "INSERT INTO tblissue (issueDate,returnDate,issueStatus,returnStatus,panalty,panaltyStatus,userId,bookId) VALUES('$issueDate','$returnDate','pending','pending',0,'notpayed',$userId,$bookId)";
            $exc_insert_query = mysqli_query($connection,$insert_query);

            //check if the qiery success
            if($exc_insert_query){
                echo '<div role="alert">request palced!</div>';
                $msg_sucess = true;
            }else{
                echo '<div role="alert"> '.mysqli_error($connection).'</div>';
                $msg_error = true;
            }
        }else{
            echo '<div role="alert">invalide email or pasword!</div>';
            $msg_error = true;
        }
    }
?>
<script>
    var msg_error = "<?php echo $msg_error;?>";
    var msg_sucess = "<?php echo $msg_sucess;?>";
    
    if(msg_error == true){
        $("#barrow_satus_msg").addClass("alert alert-danger");
        $("#barrow_satus_msg").removeClass("alert alert-success");
    }else if(msg_sucess == true){
        $("#barrow_satus_msg").addClass("alert alert-success");
        $("#barrow_satus_msg").removeClass("alert alert-danger");
    }
    
</script>
<?php mysqli_close($connection);?>
<?php require_once('inc/connection.php'); ?>
<?php
    $msg_error = false;
    $msg_sucess = false; 
    //check if the reactivate button clicked
    if(isset($_POST['reactivate']) && $_POST['userId']!= ''){
        //get user id
        $userId = $_POST['userId'];
        //prepaer update query
        $update_query = "UPDATE tbluser SET userStatus='active' WHERE userId='$userId' LIMIT 1";
        $exc_update_query = mysqli_query($connection,$update_query);

        if($exc_update_query){
            $msg_sucess = true;
            echo 'reactivate success!';
        }else{
            $msg_error = true;
            echo 'reactivate failed!';
        }
    }else{
        echo '<div role="alert" class="alert alert-warning text-center mt-2">please select email or search email!</div>';
    }
?>
<script>
    var msg_error = "<?php echo $msg_error;?>";
    var msg_sucess = "<?php echo $msg_sucess;?>";
    
    if(msg_error == true){
        $("#user_ststus_msg").addClass("alert-danger");
        $("#user_ststus_msg").removeClass("alert-success");
    }else if(msg_sucess == true){
        $("#user_ststus_msg").addClass("alert-success");
        $("#user_ststus_msg").removeClass("alert-danger");
    }
</script>
<?php mysqli_close($connection); ?>
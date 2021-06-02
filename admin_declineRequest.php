<?php require_once('inc/connection.php'); ?>
<?php
    $msg_error = false;
    $msg_sucess = false; 
    //check if the decline button clicked
    if(isset($_POST['decline'])){
        //get issue Id
        $issueId = $_POST['issueId'];
        //prepare update query
        $update_query = "UPDATE tblissue SET issueStatus='decline' WHERE issueId='$issueId' LIMIT 1";
        $exc_update_query = mysqli_query($connection,$update_query);

        if($exc_update_query){
            echo '<div class="text-center p-1" role="alert">Declined request!</div>';
            $msg_sucess = true;
        }else{
            echo '<div role="alert" class="text-center p-1">Decline dined!</div>';
            $msg_error = true;
        }
    }
?>
<script>
    var msg_error = "<?php echo $msg_error;?>";
    var msg_sucess = "<?php echo $msg_sucess;?>";
    
    if(msg_error == true){
        $("#approve_status_msg").addClass("alert alert-danger");
        $("#approve_status_msg").removeClass("alert alert-warning");
    }else if(msg_sucess == true){
        $("#approve_status_msg").addClass("alert alert-warning");
        $("#approve_status_msg").removeClass("alert alert-danger");
    }
</script>
<?php mysqli_close($connection); ?>
<?php require_once('inc/connection.php'); ?>
<?php
    $msg_error = false;
    $msg_sucess = false; 
    //check if the delete button clicked
    if(isset($_POST['deleteIssue'])){
        //get issue Id
        $issueId = $_POST['issueId'];
        //prepare delete query
        $delete_query = "DELETE FROM tblissue WHERE issueId='$issueId' LIMIT 1";
        $exc_delete_query = mysqli_query($connection,$delete_query);

        if($exc_delete_query){
            echo '<div class="text-center p-1" role="alert">Deleted!</div>';
            $msg_sucess = true;
        }else{
            echo '<div role="alert" class="text-center p-1">Delete dined!</div>';
            $msg_error = true;
        }
    }
?>
<script>
    var msg_error = "<?php echo $msg_error;?>";
    var msg_sucess = "<?php echo $msg_sucess;?>";
    
    if(msg_error == true){
        $("#approve_status_msg").addClass("alert alert-danger");
        $("#approve_status_msg").removeClass("alert alert-success");
    }else if(msg_sucess == true){
        $("#approve_status_msg").addClass("alert alert-success");
        $("#approve_status_msg").removeClass("alert alert-danger");
    }
</script>
<?php mysqli_close($connection); ?>
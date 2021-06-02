<?php require_once('inc/connection.php'); ?>
<?php
    $msg_error = false;
    $msg_sucess = false;

    //check if the return clicked
    if(isset($_POST['issueId'])){
        //sanitize variables
        $issueId = $_POST['issueId'];

        //prepare update query
        $update_query = "UPDATE tblIssue SET returnStatus='returned' WHERE issueId = '$issueId'";
        $exc_update_query = mysqli_query($connection,$update_query);

        //if query success
        if($exc_update_query){
            echo '<div role="alert">Return success!</div>';
            $msg_sucess = true;
        }else{
            echo '<div role="alert">Return failed!</div>';
            $msg_error = true;
        }
    }
?>
<script>
    var msg_error = "<?php echo $msg_error;?>";
    var msg_sucess = "<?php echo $msg_sucess;?>";
    
    if(msg_error == true){
        $("#return_status_msg").addClass("alert alert-danger");
        $("#return_status_msg").removeClass("alert alert-success");
    }else if(msg_sucess == true){
        $("#return_status_msg").addClass("alert alert-success");
        $("#return_status_msg").removeClass("alert alert-danger");
    }
</script>
<?php mysqli_close($connection); ?>
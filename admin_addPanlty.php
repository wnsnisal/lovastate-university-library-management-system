<?php require_once('inc/connection.php'); ?>
<?php
    $msg_error = false;
    $msg_sucess = false;

    //check if the add button clicked
    if(isset($_POST['addPanalty']) && $_POST['panaltyFee'] != 0.00){
        //sanitize variables
        $issueId = $_POST['issueId'];
        $panaltyFee = $_POST['panaltyFee'];

        //prepare update query
        $update_query = "UPDATE tblissue SET panalty='$panaltyFee' WHERE issueId='$issueId' LIMIT 1";
        $exc_update_query = mysqli_query($connection,$update_query);
        

        //if query success
        if($exc_update_query){
            echo 'Panalty added!';
            $msg_sucess = true;
        }else{
            echo 'panalty added failed!';
            $msg_error = true;
        }
    }else{
        echo '<div role="alert" class="alert alert-warning text-center mt-2">Please select the issue details first.</div>';
    }
?>
<script>
    var msg_error = "<?php echo $msg_error;?>";
    var msg_sucess = "<?php echo $msg_sucess;?>";
    
    if(msg_error == true){
        $("#panaltyStatus_ststus_msg").addClass("alert alert-danger");
        $("#panaltyStatus_ststus_msg").removeClass("alert alert-success");
    }else if(msg_sucess == true){
        $("#panaltyStatus_ststus_msg").addClass("alert alert-success");
        $("#panaltyStatus_ststus_msg").removeClass("alert alert-danger");
    }
    
</script>
<?php mysqli_close($connection); ?>
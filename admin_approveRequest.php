<?php require_once('inc/connection.php'); ?>
<?php
    $msg_error = false;
    $msg_sucess = false; 
    //check if the approve button clicked
    if(isset($_POST['approve'])){
        //get issue Id
        $issueId = $_POST['issueId'];
        //prepare update query
        $update_query = "UPDATE tblissue SET issueStatus='approved' WHERE issueId='$issueId' LIMIT 1";
        $exc_update_query = mysqli_query($connection,$update_query);

        if($exc_update_query){
            echo '<div class="text-center p-1" role="alert">Approved!</div>';
            $msg_sucess = true;
        }else{
            echo '<div role="alert" class="text-center p-1">Approved dined!</div>';
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
<?php require_once('inc/connection.php'); ?>
<?php
    //check if pay and return button clicked
    if(isset($_POST['payAndReturn'])){
        //sanitize the variables
        $issueId = $_POST['issueId'];
        //prepare update query
        $update_query = "UPDATE tblissue SET panaltyStatus='payed', returnStatus='returned' WHERE issueId='$issueId'";
        $exc_update_query = mysqli_query($connection,$update_query);

        //check if the query success
        if($exc_update_query){
            echo '<div id="pay_ststus_msg" role="alert" class="alert alert-success text-center mt-2">Payment placed and return success</div>';
        }else{
            echo 'Payment failed';
        }
    }
?>
<?php mysqli_close($connection); ?>
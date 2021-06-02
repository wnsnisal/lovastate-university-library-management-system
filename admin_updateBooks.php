<?php require_once('inc/connection.php'); ?>
<?php
    $msg_error = false;
    $msg_sucess = false;

    //check if the edit button clicked
    if(isset($_POST['edit_edit'])){
        //sanitize variables
        $bookId = $_POST['edit_bookId'];
        $bookName = mysqli_real_escape_string($connection,$_POST['edit_bookName']);
        $publisher = mysqli_real_escape_string($connection,$_POST['edit_publisher']);
        $category = mysqli_real_escape_string($connection,$_POST['edit_category']);
        $discription = mysqli_real_escape_string($connection,$_POST['edit_discription']);
        $quentity = mysqli_real_escape_string($connection,$_POST['edit_quentity']);

        //prepare update query
        $update_query = "UPDATE tblbooks SET bookName ='$bookName', publisher='$publisher', category='$category', discription='$discription', quentity='$quentity', bookStatus='available' WHERE bookId='$bookId'";
        $exc_update_query = mysqli_query($connection,$update_query);

        //if query success
        if($exc_update_query){
            echo '<div role="alert">update success!</div>';
            $msg_sucess = true;
        }else{
            echo '<div role="alert">invalide inputs please try agan!</div>';
            $msg_error = true;
        }
    }
?>
<script>
    var msg_error = "<?php echo $msg_error;?>";
    var msg_sucess = "<?php echo $msg_sucess;?>";
    
    if(msg_error == true){
        $("#update_status_msg").addClass("alert alert-danger");
        $("#update_status_msg").removeClass("alert alert-success");
    }else if(msg_sucess == true){
        $("#update_status_msg").addClass("alert alert-success");
        $("#update_status_msg").removeClass("alert alert-danger");
    }
    
</script>
<?php mysqli_close($connection); ?>
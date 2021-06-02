<?php require_once('inc/connection.php'); ?>
<?php
    $msg_error = false;
    $msg_sucess = false;

    //check if the edit button clicked
    if(isset($_POST['delete_edit'])){
        //sanitize variables
        $bookId = $_POST['delete_bookId'];
        $bookName = mysqli_real_escape_string($connection,$_POST['delete_bookName']);
        $publisher = mysqli_real_escape_string($connection,$_POST['delete_publisher']);
        $category = mysqli_real_escape_string($connection,$_POST['delete_category']);
        $discription = mysqli_real_escape_string($connection,$_POST['delete_discription']);
        $quentity = mysqli_real_escape_string($connection,$_POST['delete_quentity']);

        //prepare update query(for delet book)
        $update_query = "UPDATE tblbooks SET quentity=0, bookStatus='deleted' WHERE bookId='$bookId'";
        $exc_update_query = mysqli_query($connection,$update_query);

        //if query success
        if($exc_update_query){
            echo '<div role="alert">Delete success!</div>';
            $msg_sucess = true;
        }else{
            echo '<div role="alert">Delete failed!</div>';
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
<?php require_once('inc/connection.php'); ?>
<?php
    $msg_error = false;
    $msg_sucess = false;

    //check if the add button clicked
    if(isset($_POST['add'])){
        //sanitize variables
        $bookName = mysqli_real_escape_string($connection,$_POST['bookName']);
        $publisher = mysqli_real_escape_string($connection,$_POST['publisher']);
        $category = mysqli_real_escape_string($connection,$_POST['category']);
        $discription = mysqli_real_escape_string($connection,$_POST['discription']);
        $quentity = mysqli_real_escape_string($connection,$_POST['quentity']);

        //prepare insert query
        $insert_query = "INSERT INTO tblbooks (bookName,publisher,category,discription,quentity,bookStatus) VALUES('$bookName','$publisher','$category','$discription','$quentity','available')";
        $exc_insert_query = mysqli_query($connection,$insert_query);

        //if query success
        if($exc_insert_query){
            echo '<div role="alert">add success!</div>';
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
        $("#status_msg").addClass("alert alert-danger");
        $("#status_msg").removeClass("alert alert-success");
    }else if(msg_sucess == true){
        $("#status_msg").addClass("alert alert-success");
        $("#status_msg").removeClass("alert alert-danger");
    }
    
</script>
<?php mysqli_close($connection); ?>
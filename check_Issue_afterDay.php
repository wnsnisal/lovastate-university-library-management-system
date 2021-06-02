<?php require_once('inc/connection.php'); ?>
<?php 
    //refresh after every 24 hours
    header("refresh: 60*60*24"); 
    //get current data
    $current_date = date('Y-m-d');
    //prepare select query
    $select_query = "SELECT * FROM tblissue";
    $exc_select_query = mysqli_query($connection,$select_query);
    $rowCount = mysqli_num_rows($exc_select_query);
    //check each record
    for($i=0;$i<$rowCount;$i++){
        $records = mysqli_fetch_assoc($exc_select_query);
        //sanitize varibales(get current date and issue id)
        $returnDate = $records['returnDate'];
        $issueId = $records['issueId'];
        //if returndat and current date equal
        if($returnDate == $current_date){
            //prepare update query
            $update_query = "UPDATE tblissue SET returnStatus = 'expired' WHERE issueId = '$issueId'";
            $exc_update_query = mysqli_query($connection,$update_query);
        }
    }
?> 

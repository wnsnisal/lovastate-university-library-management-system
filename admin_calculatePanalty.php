<?php require_once('inc/connection.php'); ?>
<?php
    //check if the calculate button clicked
    if(isset($_POST['calculate'])){
        //sanitize variables
        $today = $_POST['today'];
        $returnDate = $_POST['returnDate'];
        //get total expired dates
        $today_val=date_create($today);
        $returnDate_val=date_create($returnDate);
        $diff=date_diff($returnDate_val,$today_val);
        $totalDays = $diff->format("%a");
        //panalty fee for a day
        $panalti_for_day = 5.00;
        //calculate total panalty fee
        $totalPanalty_fee = $totalDays * $panalti_for_day;
        echo $totalPanalty_fee.".00";
    }
?>
<?php mysqli_close($connection); ?>
<?php
    //create connection
    $connection = mysqli_connect('localhost','root','','library_db');
    //checking the connection
    if(mysqli_connect_error()){
        die('Databese connection failed'. mysqli_connect_error());
    }
?>
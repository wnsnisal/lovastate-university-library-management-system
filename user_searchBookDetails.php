<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php
    //check if search button clicked
    if(isset($_POST['searchBook'])){
        //get search book name
        $search_bookName = $_POST['search_bookName'];
        
        //select book details from the book table
        $query = "SELECT * FROM tblbooks WHERE bookStatus = 'available' AND bookName='$search_bookName' LIMIT 1";
        $exc_query = mysqli_query($connection,$query);
        $rowCount = mysqli_num_rows($exc_query);

        //check if the query excuited
        if($rowCount != 0){
            $table = '<table class="tblBookDetails table" id="tblBookDetails">';
            $table .= '<thead class="thead-light"><tr><th class="hidden" scope="col">#</th><th scope="col">Book name</th><th scope="col">Publisher</th><th class="hidden" scope="col" id="bookDiscription">discription</th><th scope="col">Action</th></tr></thead>';
    
                $record = mysqli_fetch_assoc($exc_query);
    
                $table .= '<tbody>';
                $table .= '<tr>';
                $table .= '<th class="hidden" scope="row" id="view_bookId">'.$record['bookId'].'</th>';
                $table .= '<td id="view_bookName">'.$record['bookName'].'</td>';
                $table .= '<td id="view_publisher">'.$record['publisher'].'</td>';
                $table .= '<td id="view_discription" class="hidden">'.$record['discription'].'</td>';
                $table .= '<td id="view_category" class="hidden">'.$record['category'].'</td>';
                $table .= '<td id="view_action"><button id="btnBarrowBook" class="btn btn-primary btn-sm btnBarroBook" data-toggle="modal" data-target="#exampleModal">View</button></td>';
                $table .= '<tr>';
                $table .= '</tbody>';
            $table.="</table>";

                echo $table;
        }else{
            echo '<div role="alert" class="alert alert-warning text-center">thair is no any book regarding '.$search_bookName.'</div>';
        }
    }
?>
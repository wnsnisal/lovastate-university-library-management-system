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
                $table = '<table class="tblBookDetails table table-striped">';
                $table .= '<thead class="thead-dark"><tr><th scope="col"></th><th scope="col">id</th><th scope="col">book Name</th><th scope="col">Publisher</th><th scope="col">category</th><th scope="col">discription</th><th scope="col">quentity</th></tr></thead>';
                    $record=mysqli_fetch_assoc($exc_query);
                    $table .= '<tbody class="tboddy-dark">';
                    $table .= '<tr id="select_book">';
                    $table .= '<td id="Edit_button"><button class="btn btn-success viewBook" id="btnViewBook" value="#btnViewBook" name="viewBook" data-toggle="modal" data-target="#modEditBookDetails">Edit</button></td>';
                    $table .= '<td id="Edit_bookId">'.$record['bookId'].'</td>';
                    $table .= '<td id="Edit_bookName"  style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;max-width: 130px;">'.$record['bookName'].'</td>';
                    $table .= '<td id="Edit_publisher">'.$record['publisher'].'</td>';
                    $table .= '<td id="Edit_category">'.$record['category'].'</td>';
                    $table .= '<td id="Edit_discription" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;max-width: 130px;">'.$record['discription'].'</td>';
                    $table .= '<td id="Edit_quentity" style="background-color: rgb(160, 160, 160,0.3); color:rgb(43, 43, 43);">'.$record['quentity'].'</td>';
                    $table .= '</tr>';
                    $table .= '</tbody>';
                $table .= '</table>';

                echo $table;
        }else{
            echo '<div role="alert" class="alert alert-warning text-center">thair is no any book regarding '.$search_bookName.'</div>';
        }
    }
?>
<?php
    require_once('inc/connection.php');

    if(isset($_GET['category'])){

        $book_category = $_GET['category'];
 
        if($book_category== 'All'){
            $query = "SELECT * from tblbooks WHERE bookStatus='available'";
        }else{
            $query = "SELECT * from tblbooks WHERE category = '$book_category' AND bookStatus='available'";
        }
        $exc_query = mysqli_query($connection, $query);
        $rowCount = mysqli_num_rows($exc_query);
        if(!($rowCount == 0)){
        $table = '<table class="tblBookDetails table" id="tblBookDetails">';
        $table .= '<thead class="thead-light"><tr><th class="hidden" scope="col">#</th><th scope="col">Book name</th><th scope="col">Publisher</th><th class="hidden" scope="col" id="bookDiscription">discription</th><th scope="col">Action</th></tr></thead>';
        for($i = 0; $i<$rowCount; $i++){

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
        }
        $table.="</table>";
        echo $table;
        }else{
            echo '<div role="alert" class="alert alert-warning text-center">thair is no '.$book_category.' books in the system!</div>';
        }
    }
    else{
        echo "error";
    }
?>
<script>
    $(document).ready(function(){
        $(".btnBarroBook").click(function(){
            // find the row
            var row = $(this).closest("tr"); 
            // Find the text values
            var bookId = row.find("#view_bookId").text();
            var bookName = row.find("#view_bookName").text();
            var publisher = row.find("#view_publisher").text();
            var discription = row.find("#view_discription").text();
            var category = row.find("#view_category").text();

            document.getElementById("bookName").textContent = bookName;
            document.getElementById("publisher").textContent = publisher;
            document.getElementById("discription").textContent = discription;
            document.getElementById("category").textContent = category;
        });
    });
</script>
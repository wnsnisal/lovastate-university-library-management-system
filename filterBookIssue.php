<?php require_once('inc/connection.php'); ?>
<?php
if(isset($_POST['issue_result'])){
    $issue_result = $_POST['issue_result'];

    //select query for get user Id
    $user_query = "SELECT * FROM tbluser WHERE email = '$issue_result' LIMIT 1";
    $exc_user_query = mysqli_query($connection,$user_query);
    $rowCount = mysqli_num_rows($exc_user_query);

    if($rowCount != 0){
        $record = mysqli_fetch_assoc($exc_user_query);
        $searched_userId= $record['userId'];
        //select query for get issue details
        $query = "SELECT * FROM tblissue WHERE userId = '$searched_userId' ORDER BY 'issueDate'";
        $exc_query = mysqli_query($connection,$query);

        //check if the query excuited
        if($exc_query){
            $rowCount = mysqli_num_rows($exc_query);

            $table = '<table class="tblIssueDetails table table-striped" style="font-size:12px;">';
            $table .= '<thead class="thead-dark"><tr><th scope="col"></th><th scope="col">Book Name</th><th style="display:none;">UserId</th><th scope="col">Email</th><th scope="col">Issue Date</th><th scope="col">Return Date</th><th scope="col">Issue Status</th></tr></thead>';
            for($i = 0; $i<$rowCount; $i++){
                $issue_record=mysqli_fetch_assoc($exc_query);
                //get issue Id
                $issueId = $issue_record['issueId'];
                //get book Id
                $bookId = $issue_record['bookId'];
                //select query for get book name
                $book_select_query = "SELECT * FROM tblbooks WHERE bookId = '$bookId' LIMIT 1";
                $exc_book_select_query = mysqli_query($connection,$book_select_query);
                $book = mysqli_fetch_assoc($exc_book_select_query);

                //if query success
                if($exc_book_select_query){
                    $bookName = $book['bookName'];
                }

                //get user Id
                $userId = $issue_record['userId'];
                //select query for get user email
                $user_select_query = "SELECT * FROM tbluser WHERE userId = '$userId' LIMIT 1";
                $exc_user_select_query = mysqli_query($connection,$user_select_query);
                $user = mysqli_fetch_assoc($exc_user_select_query);

                //if query success
                if($exc_user_select_query){
                    $email = $user['email'];
                }

                $table .= '<tbody class="tboddy-dark">';
                $table .= '<tr>';
                $table .= '<td id="tdIssueId" style="display:none;">'.$issueId.'</td>';
                $table .= '<td id="tdAction"><button id="btnSelect" class="btn btn-warning btn-sm btnViewUser">select</button></td>';
                $table .= '<td id="tdBookName">'.$bookName.'</td>';
                $table .= '<td id="tdUserId" style="display:none;">'.$userId.'</td>';
                $table .= '<td id="tdEmail">'.$email.'</td>';
                $table .= '<td id="tdIssueDate">'.$issue_record['issueDate'].'</td>';
                $table .= '<td id="tdReturnDate">'.$issue_record['returnDate'].'</td>';
                $table .= '<td id="tdIssueStatus">'.$issue_record['issueStatus'].'</td>';
                $table .= '</tr>';
                $table .= '</tbody>';
            }
            $table .= '</table>';
            echo $table;
        }else{
            echo '<div role="alert" class="alert alert-danger text-center">Invalide Email!</div>';
        }

    }else{
        echo '<div role="alert" class="alert alert-danger text-center">Invalide Email!</div>';
    }
}else{
    echo '<div role="alert" class="alert alert-danger text-center">Invalide Email!</div>';
}
?>
<script>
    $(document).ready(function(){
        //view user details regarding issue
        $(".btnViewUser").click(function(){
            // find the row
            var row = $(this).closest("tr");
            // Find the user Id
            var issueId = row.find("#tdIssueId").text();
            var getURL = "admin_currentIssue_getUserDetails.php?issueId=" + issueId;
            $.get(getURL, function(data, status){
                $("#divRquestedUser").html(data);
            });

            var userId = row.find("#tdUserId").text();
            $("#divReturn").load('admin_getRequestedUser.php',{
                userId:userId
            });
        });
    });
</script>
<?php require_once('inc/connection.php'); ?>
<?php
    $msg_error = false;
    $msg_sucess = false; 
    //check if the user selected
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        //prepare select query for get user details
        $select_user_query = "SELECT * FROM tbluser WHERE email='$email' LIMIT 1";
        $exc_select_user_query = mysqli_query($connection,$select_user_query);
        if(mysqli_num_rows($exc_select_user_query) != 0){
            $user = mysqli_fetch_assoc($exc_select_user_query);
            $userId = $user['userId'];
            //prapare select query for get issue details
            $select_issue_query = "SELECT * FROM tblissue WHERE userId='$userId' AND returnStatus='expired'";
            $exc_select_issue_query = mysqli_query($connection,$select_issue_query);
            //if query success
            if($exc_select_issue_query){
                $rowCount = mysqli_num_rows($exc_select_issue_query);
    
                $table = '<table id="tblBooksTopic" class="table table-striped" style="font-size:12px;"><thead class="thead-dark"><tr><th class="TdOne">Book Name</th><th style="display:none;">issueId</th><th class="TdTwo">Barrowed Date</th><th class="TdThree">Return Date</th><th>panalty</th><th></th></tr></thead>';
                for($i=0;$i<$rowCount;$i++){
                    $records = mysqli_fetch_assoc($exc_select_issue_query);
                    $bookId = $records['bookId'];
                    $issueId = $records['issueId'];
                    $panlry = $records['panalty'];
                    //select query for ge tbook name
                    $select_book_query = "SELECT * FROM tblbooks WHERE bookId = '$bookId' LIMIT 1";
                    $exc_select_book_query = mysqli_query($connection,$select_book_query);
    
                    $book = mysqli_fetch_assoc($exc_select_book_query);
                    $bookName = $book['bookName'];
    
                    $table .= '<tbody>';
                    $table .= '<tr><td id="tdBookName">'.$bookName.'</td>';
                    $table .= '<td id="tdIssueId" style="display:none;">'.$issueId.'</td>';
                    $table .= '<td id="tdIssueDate">'.$records['issueDate'].'</td>';
                    $table .= '<td id="tdReturnDate">'.$records['returnDate'].'</td>';
                    $table .= '<td id="tdPanalty">'.$records['panalty'].'</td>';
                    $table .= '<td><button id="btnSetPanalty" class="btn btn-warning btn-sm btnSetPanalty" name="setPanalty" data-toggle="tooltip" data-placement="top" title="Calculate panalty for this expired book issue">panlty</button></td></tr>';
                    $table .= '</tbody>';
                }
                $table .= '</table>';
                echo $table;
            }else{
                echo 'error';
            }
        }else{
            echo '<div role="alert" class="alert alert-danger text-center">invalid email!</div>';
        }
        
    }
    
?>
<script>
    var msg_error = "<?php echo $msg_error;?>";
    var msg_sucess = "<?php echo $msg_sucess;?>";
    
    if(msg_error == true){
        $("#approve_status_msg").addClass("alert alert-danger");
        $("#approve_status_msg").removeClass("alert alert-success");
    }else if(msg_sucess == true){
        $("#approve_status_msg").addClass("alert alert-success");
        $("#approve_status_msg").removeClass("alert alert-danger");
    }
</script>
<script>
    $(document).ready(function(){
        //get details to panalty form
        $(".btnSetPanalty").click(function(){
            // find the row
            var row = $(this).closest("tr"); 
            // Find the text values
            var issueId = row.find("#tdIssueId").text();
            var returnDate = row.find("#tdReturnDate").text();

            document.getElementById("txtReturnDate").value = returnDate;
            document.getElementById("p_issueId").value = issueId;
        });
    });
</script>
<?php mysqli_close($connection); ?>
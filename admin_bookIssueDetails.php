<?php require_once('inc/connection.php'); ?>
<?php
    //select query for get issue details
    $query = "SELECT * FROM tblissue WHERE returnStatus = 'pending' OR returnStatus = 'expired' ORDER BY bookId";
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
    }else{
        echo "error";
    }
?>
<!--contant for book issue details-->
<div id="divBookIssueDetails">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <form action="" class="form-inline" method="post">
                <div class="form-group">
                    <input name="searchIssue" type="text" aria-describedby="searchIssue" class="form-control" id="txtSearchIssue" placeholder="Search Email">
                </div>
                <div class="form-group ml-1">
                    <button id="btnSearchIssue" class="btn btn-danger btn-sm"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <h4 class="text text-dark text-center">Book Requests</h4>
            <div class="max_height" id="book_requests">
                <?php echo $table; ?>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <h4 class="text text-dark text-center">Requested User Details</h4>
        <div class="max_height">
            <div class="div" id="divRquestedUser">
                <table id="tblRquestedUser" class="table">
                    <tr>
                        <td class="lable text-secondary">Full Name</td>
                        <td id="tdFullNameRequested"></td>
                    </tr>
                    <tr>
                        <td class="lable text-secondary">Email</td>
                        <td id="tdEmailRequested"></td>
                    </tr>
                    <tr>
                        <td class="lable text-secondary">Mobile No</td>
                        <td id="tdMobileNoRequested"></td>
                    </tr>
                    <tr>
                        <td class="lable text-secondary">NIC</td>
                        <td id="tdNicRequested"></td>
                    </tr>
                    <tr>
                        <td class="lable text-secondary">Address/Zip</td>
                        <td id="tdAddressOrZipRequested"></td>
                    </tr>
                    <tr>
                        <td class="lable text-secondary">Profetion</td>
                        <td id="tdProfetionRequested"></td>
                    </tr>
                    <tr>
                        <td class="lable text-secondary">Selected Book</td>
                        <td class="text-dark" id="tdProfetionRequested"></td>
                    </tr>
                </table>
            </div>
            <form action="" method="post" id="frmApproveRequest" class="mt-2">
                <button id="btnApprove" class="btn btn-primary" value="approve">Approve</button>
                <button id="btnDecline" class="btn btn-danger" value="decline">Decline</button>
                <button id="btnDelete" class="btn btn-dark" value="delete">Delete Request</button>
            </form>
            <!--display status-->
            <p id="approve_status_msg" class="mt-1"></p>
            <hr>
            <div class="col-12 mt-3">
                <h4 class="text text-dark text-center">Return Books</h4>
            </div>
            <div id="divReturn">
                
            </div>
            <p id="return_status_msg" class="mt-1"></p>
        </div>
        </div>
    </div>
    <hr>  
    <div class="row">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
            <h4 class="text text-dark text-center">Return expired book issue details</h4>
            <div id="divExpiredIssueDetails">
                <?php
                        //prapare select query for get issue details
                        $select_issue_query = "SELECT * FROM tblissue WHERE returnStatus='expired'";
                        $exc_select_issue_query = mysqli_query($connection,$select_issue_query);
                        //if query success
                        if($exc_select_issue_query){
                            $rowCount = mysqli_num_rows($exc_select_issue_query);
                
                            $table = '<table id="tblBooksTopic" class="table table-striped" style="font-size:12px;"><thead class="thead-dark"><tr><th class="TdOne">email</th><th class="TdOne">Book Name</th><th style="display:none;">issueId</th><th class="TdTwo">Barrowed Date</th><th class="TdThree">Return Date</th><th>panalty</th><th></th></tr></thead>';
                            for($i=0;$i<$rowCount;$i++){
                                $records = mysqli_fetch_assoc($exc_select_issue_query);
                                $bookId = $records['bookId'];
                                $userId = $records['userId'];
                                $issueId = $records['issueId'];
                                $panlry = $records['panalty'];
                                //select query for get book name
                                $select_book_query = "SELECT * FROM tblbooks WHERE bookId = '$bookId' LIMIT 1";
                                $exc_select_book_query = mysqli_query($connection,$select_book_query);
                
                                $book = mysqli_fetch_assoc($exc_select_book_query);
                                $bookName = $book['bookName'];

                                //select query for get user name
                                $select_user_query = "SELECT * FROM tbluser WHERE userId = '$userId' LIMIT 1";
                                $exc_select_user_query = mysqli_query($connection,$select_user_query);
                
                                $user = mysqli_fetch_assoc($exc_select_user_query);
                                $email = $user['email'];
                
                                $table .= '<tbody>';
                                $table .= '<tr><td id="tdEmail">'.$email.'</td>';
                                $table .= '<td id="tdBookName">'.$bookName.'</td>';
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
                ?>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 mt-4 div" >
                <h4 class="text-dark">Calculate Penalty</h4>
                <hr>
                <form method="post" id="frmCalculateFine">
                    <p id="p_issueId" style="display:none;"></p>
                    <div class="form-group">
                        <label for="txtToday">Today</label>
                        <input type="text" class="form-control" id="txtToday" placeholder="Today" value="<?php echo date('Y-m-d');?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="txtReturnDate">Return date</label>
                        <input type="text" class="form-control" id="txtReturnDate" placeholder="Return date">
                    </div>
                    <div class="form-group">
                        <button id="btnCalculate" class="btn btn-danger" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" value="calculate">Calculate</button>
                    </div>
                </form>
                <!--Display panalty fee in collapse-->
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <div class="form-group bg-secondary" style="padding:10px;border-radius:5px;">
                            <label class="text text-light">panlty fee</label>
                            <P type="text" class="form-control text-success" id="p_answer" style="font-size:24px;"></p>
                        </div>
                        <div class="form-group">
                            <button id="btnAddFine" class="btn btn-primary" value="addPanalty">Add Penalty</button>
                        </div>
                        <div id="panaltyStatus_ststus_msg" role="alert" class="text-center mt-2"></div>
                    </div>
                </div>
        </div>
    </div>
    
</div>


<!-- inport jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<!--AJAX codes-->
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
            //return book
            var userId = row.find("#tdUserId").text();
            $("#divReturn").load('admin_getRequestedUser.php',{
                userId:userId
            });
        });
        //approve the request
        $("#btnApprove").click(function(event){
            event.preventDefault();
            var issueId = $("#tdCurrentIssueId").text();
            var approve = $("#btnApprove").val();
            $("#approve_status_msg").load('admin_approveRequest.php',{
                issueId:issueId,
                approve:approve
            });
        });
        //approve the request
        $("#btnDecline").click(function(event){
            event.preventDefault();
            var issueId = $("#tdCurrentIssueId").text();
            var decline = $("#btnDecline").val();
            $("#approve_status_msg").load('admin_declineRequest.php',{
                issueId:issueId,
                decline:decline
            });
        });

        //delete issue request
        $("#btnDelete").click(function(event){
            event.preventDefault();
            var issueId = $("#tdCurrentIssueId").text();
            var deleteIssue = $("#btnDelete").val();
            $("#approve_status_msg").load('admin_deleteIssueRequset.php',{
                issueId:issueId,
                deleteIssue:deleteIssue
            });
        });
        
        //filter issue result category
        $("#btnSearchIssue").click(function(event){
            event.preventDefault();
            var issue_result = $("#txtSearchIssue").val();
            $("#book_requests").load("filterBookIssue.php",{
                issue_result:issue_result
            });
        });

        //calculate panalty
        $("#btnCalculate").click(function(event){
            event.preventDefault();
            var today = $("#txtToday").val();
            var returnDate = $("#txtReturnDate").val();
            var calculate = $("#btnCalculate").val();

            $("#p_answer").load("admin_calculatePanalty.php",{
                today:today,
                returnDate:returnDate,
                calculate:calculate
            });
        });
        //add panalty
        $("#btnAddFine").click(function(){
            var panaltyFee = $("#p_answer").text();
            var issueId = $("#p_issueId").val();
            var addPanalty = $("#btnAddFine").val();

            $("#panaltyStatus_ststus_msg").load("admin_addPanlty.php",{
                panaltyFee:panaltyFee,
                issueId:issueId,
                addPanalty:addPanalty
            });
        });
    });
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
<?php require_once('inc/connection.php'); ?>
<?php
    //prepare selec query for get user details from user table
    $select_query = "SELECT * FROM tbluser";
    $exc_select_query = mysqli_query($connection,$select_query);

    //if query success
    if($exc_select_query){
        $rowCount = mysqli_num_rows($exc_select_query);

        //cerate user details table
        $table = '<table id="tblUserListTopic" class="table table-striped table-info" style="font-size:12px;">';
        $table .= '<thead class=""><tr class="bg-info text-light"><th scope="col" style="display:none;">#</th><th scope="col">Email</th><th scope="col">Profile</th><th scope="col">user Status</th></tr></thead>';
        //check every records one by one using for loop
        for($i=0;$i<$rowCount;$i++){
            $records = mysqli_fetch_assoc($exc_select_query);
            //sanitize variables
            $userId = $records['userId'];
            $email=$records['email'];
            $profetion = $records['userType'];
            $userStatus = $records['userStatus'];
            //asign variabkls to the table
            $table .= '<tbody>';
            $table .= '<tr>';
            $table .= '<td id="tdUserId"  style="display:none;">'.$userId.'</td>';
            $table .= '<td id="tdEmail" ><a href="" class="text-decoration-none text-dark select">'.$email.'</a></td>';
            $table .= '<td id="tdProfetion" >'.$profetion.'</td>';
            $table .= '<td id="tdUserStatus" >'.$userStatus.'</td>';
            $table .= '</tr>';
            $table .= '</tbody>';
        }
        $table .= '</table>';
    }else{
        echo "thair is no users in the system";
    }
?>
<!--contant for user details-->
<div id="divUserDetails">
    <div class="row">
        <div class="col-12">
            <form action="" class="form-inline" method="post" id="frmSearchUser">
                <div class="form-group">
                    <input name="searchEmail" type="text" aria-describedby="searchEmail" class="form-control" id="txtSearchEmail" placeholder="Search Email">
                </div>
                <div class="form-group ml-1">
                    <button id="btnSearchEmail" class="btn btn-danger btn-sm"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-2">
            <form action="" method="post" id="frmFilterUser">
                <div class="btn-group" role="group">
                    <button id="btnActiveUsers" class="btn btn-dark btn-sm ml-1 submit" value="active">active users</button>
                    <button id="btnSuspendUsers" class="btn btn-dark btn-sm ml-1 submit" value="suspend">suspend users</button>
                </div>
            </form>
        </div>
    </div>
    <hr>
    <div class="row p-2">
        <!--user list table-->
        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
            <div class="max_height" id="table_user">
                <?php echo $table; ?>
            </div>
        </div>
        <!--view user details-->
        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
            <h4 class="text text-info text-center lead">User Details</h4>
            <div class="max_height">
                <div id="div_currentUser">
                    <table id="tblCurrentUser" class="table">
                    <tbody>
                    <tr>
                        <td class="text text-secondary">Full Name</td>
                        <td id="tdFullName"></td>
                    </tr>
                    <tr>
                        <td class="text text-secondary">Email</td>
                        <td id="tdEmail"></td>
                    </tr>
                    <tr>
                        <td class="text text-secondary">Mobile No</td>
                        <td id="tdMobileNo"></td>
                    </tr>
                    <tr>
                        <td class="text text-secondary">NIC</td>
                        <td id="tdNic"></td>
                    </tr>
                    <tr>
                        <td class="text text-secondary">Address/Zip</td>
                        <td id="tdAddressOrZip"></td>
                    </tr>
                    <tr>
                        <td class="text text-secondary">Profetion</td>
                        <td id="tdProfetion"></td>
                    </tr>
                    </tbody>
                    </table> 
                </div>
                
                <hr>
                <form action="" method="post">
                    <button id="btnReactivate" class="btn btn-primary" value="reactivate">reactivate</button>
                    <button id="btnSuspend" class="btn btn-dark" value="suspend">suspend</button>
                    <div id="user_ststus_msg" role="alert" class="alert text-center mt-2"></div>
                </form>
                <h4 class="text-info text-center lead">Expired Book Details</h4>
                <div class="mt-2" id="div_BarrowDetails">
                    <table id="tblBooksTopic" class="table table-striped" style="font-size:12px;">
                        <thead class="thead-dark">
                            <tr>
                                <th class="TdOne">Book Name</th>
                                <th class="TdTwo">Barrowed Date</th>
                                <th class="TdThree">Return Date</th>
                                <th>Panalry</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--panalty details-->
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 div">
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
        
        //filter user by active users
        $("#btnActiveUsers").click(function(event){
            event.preventDefault();
        
            var submit= $("#btnActiveUsers").val();
            $("#table_user").load('admin_filterUser.php',{
                submit:submit
            });
        });
        //filter user by not suspend users
        $("#btnSuspendUsers").click(function(event){
            event.preventDefault();
        
            var submit= $("#btnSuspendUsers").val();
            $("#table_user").load('admin_filterUser.php',{
                submit:submit
            });
        });
        //get selected user details
        $(".select").click(function(event){
            event.preventDefault();
            // find the row
            var row = $(this).closest("tr");
            // Find the user Id
            var userId = row.find("#tdUserId").text();
            var email = row.find("#tdEmail").text();
            //load user details
            $("#div_currentUser").load('admin_selected_userDetails.php',{
                email:email
            });
            //load book barrow details
            $("#div_BarrowDetails").load('admin_selectedUser_barrowDetails.php',{
                email:email
            })
        });
        //search user by email
        $("#frmSearchUser").submit(function(event){
            event.preventDefault();
            var email = $("#txtSearchEmail").val();
            //load user details
            $("#div_currentUser").load('admin_selected_userDetails.php',{
                email:email
            });
            //load book barrow details
            $("#div_BarrowDetails").load('admin_selectedUser_barrowDetails.php',{
                email:email
            })
        });
        //suspend user
        $("#btnSuspend").click(function(event){
            event.preventDefault();
            var userId = $("#tdId").text();
            var suspend = $("#btnSuspend").val();
            $("#user_ststus_msg").load('admin_suspend_user.php',{
                userId:userId,
                suspend:suspend
            });
        });
        //reactivate user
        $("#btnReactivate").click(function(event){
            event.preventDefault();
            var userId = $("#tdId").text();
            var reactivate = $("#btnReactivate").val();
            $("#user_ststus_msg").load('admin_reactivate_user.php',{
                userId:userId,
                reactivate:reactivate
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
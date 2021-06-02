
<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php
    $updatedPassword="";
    //view user details
    $userId = $_SESSION['userId'];
    //create database query for get user details
    $query = "SELECT * FROM tbluser WHERE userId='$userId'";
    //excute query
    $excute_query = mysqli_query($connection, $query);

    $user = mysqli_fetch_assoc($excute_query);
    $currentPassword= base64_encode($user['password']);
?>
<?php
    $userId = $_SESSION['userId'];

    //prepare select query for get book issue details from issue table
    $issue_select_query = "SELECT * FROM tblissue WHERE userid='$userId' AND returnStatus='pending'";
    $exc_issue_select_query = mysqli_query($connection,$issue_select_query);
    
    //if select query success
    if($exc_issue_select_query){
        $rowCount = mysqli_num_rows($exc_issue_select_query);

        $table = '<table id="tblRequests" class="table table-info">';
        $table .= '<thead class="thead thead-dark"><tr><th>book name</th><th>barrow day</th><th>return date</th><th>status</th><th>panalty</th></tr></thead>';
        $table .= '<tbody class="text-info">';
        //get row one by one using for loop
        for($i=0;$i<$rowCount;$i++){
            $issue = mysqli_fetch_assoc($exc_issue_select_query);
            //sanitize variables
            $issuDate = $issue['issueDate'];
            $returnDate = $issue['returnDate'];
            $issueStatus = $issue['issueStatus'];
            $panalty = $issue['panalty'];
            $bookId = $issue['bookId'];
            //prepare select query for get book details
            $book_select_query = "SELECT * FROM tblbooks WHERE bookId= '$bookId' LIMIT 1";
            $exc_book_select_query = mysqli_query($connection,$book_select_query);
            //if query success
            if($exc_book_select_query){
                $book = mysqli_fetch_assoc($exc_book_select_query);
                //get book name
                $bookName = $book['bookName'];
            }
            $table .= '<tr>';
            $table .= '<td>'.$bookName.'</td>';
            $table .= '<td>'.$issuDate.'</td>';
            $table .= '<td>'.$returnDate.'</td>';
            $table .= '<td>'.$issueStatus.'</td>';
            $table .= '<td>'.$panalty.'</td>';
            $table .= '</tr>';
        }
        $table .= '</tbody>';
        $table .= '</table>';
    }
?>
<div id="myProfile" class="">
    <div class="row mt-3">
        <div class="col-lg-6 col-sm-6 col-6">
            <div class="d-flex justify-content-start">
                <h4 class="text-dark">My Profile</h4>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-6">
            <div class="d-flex justify-content-end">
                <button name="back" class="btn btn-dark btn-sm" id="btnBack" onclick="backtohome();">back</button>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row mt-3">
            <!--Profile Details-->
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 div_profileDetails">
                <div class="d-flex justify-content-center">
                    <p id="subTopic" class="text-primary lead">Profile Details</p>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="txtFirstName">First name</label>
                                <input type="text" name='firstName' id="txtFirstName" class="form-control" aria-describedby="firstname"  maxlength="50" required <?php echo 'value="'.$user['firstName'].'"';?>>
                            </div>

                            <div class="form-group">
                                <label for="txtLastName">Last name</label>
                                <input type="text" name='lastName' id="txtLastName" class="form-control" aria-describedby="lasttname"  maxlength="50" required <?php echo 'value="'.$user['lastName'].'"';?>>
                            </div>
                    
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="text" name='email' id="txtEmail" class="form-control" aria-describedby="email"  maxlength="50" required <?php echo 'value="'.$user['email'].'"';?>>
                            </div>

                            <div class="form-group">
                                <label for="nic">NIC</label>
                                <input type="text" name='nic' id="txtNic" class="form-control" aria-describedby="nic"  maxlength="20" required <?php echo 'value="'.$user['NIC'].'"';?>>
                            </div>

                            <div class="form-group">
                                <label for="address">Address / ZIP</label>
                                <input type="text" name='address' id="txtAddress" class="form-control" aria-describedby="address"  maxlength="100" required <?php echo 'value="'.$user['AddressOrZip'].'"';?>>
                            </div>
                   
                            <div class="form-group">
                                <label for="sleProfection">Profetion</label>
                                <select class="form-control" id="sleProfection">
                                    <?php echo '<option>'.$user['userType'].'</option>';?>
                                    <option value="Profeser">profeser</option> 
                                    <option value="Student">student</option> 
                                </select>
                            </div>
                            <hr>
                            <label for="" class="text lead" id="subTopic">Conformation</label>
                            <div class="form-group">
                                <label for="txtLastName">you need to enter your current password to change account details.</label>
                                <input type="password" name='updatedPassword' id="txtPassword0" class="form-control" aria-describedby="password"  maxlength="50" required>
                                <i class="far fa-eye" id="eye0" onclick="eyeClick(0);"></i>
                            </div>

                            <div class="row">
                                <span class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <p class="text-center lead mt-3" id="update_satus_msg"></p>
                                </span>
                            </div>
                            <button class="btn btn-primary btn-block" name="update" id="bntUpdate" value="update">Update Account</button>
                        </form>
                        <div class="row mt-3">
                            <span class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <a class="text text-primary" data-toggle="modal" data-target="#exampleModal">Change password</a>
                            </span>
                        </div>
                    </div>
                </div>
                
            </div>
            <!--panalty details-->
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 div_panaltyDetails">

                <div class="d-flex justify-content-center">
                    <p id="subTopic" class="text-primary lead">Book Requests</p>
                </div>
                <div class="divRequests max_height">
                    <?php echo $table; ?>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="user_changePassword.php" name="frmChangePassword" method="post" class="frmChangePassword">

                        <div class="form-group">
                            <label for="txtCurrentPassword">Current Password</label>
                            <input type="password" name="txtCurrentPassword" class="form-control" aria-describedby="currentPasword" id="txtPassword1" placeholder="type the cutrrent password hear" required>
                            <i class="far fa-eye" id="eye1" onclick="eyeClick(1)"></i>
                        </div>

                        <span class="text text-success">forgot your password? please contact the librarian!</span>
                        <hr>
                        <div class="form-group">
                            <label for="txtNewPassword">New Password</label>
                            <input type="password" name="txtNewPassword" class="form-control" aria-describedby="currentPasword" id="txtPassword2" placeholder="type the new password hear" required>
                            <i class="far fa-eye" id="eye2" onclick="eyeClick(2)"></i>
                        </div>
                        <div class="form-group">
                            <label for="txtConformNewPassword">Conform New Password</label>
                            <input type="password" class="form-control" aria-describedby="currentPasword" name="txtConformNewPassword" id="txtPassword3" placeholder="type the new password hear agan" required>
                            <i class="far fa-eye" id="eye3" onclick="eyeClick(3)"></i>
                        </div>
                        <div class="row">
                            <span class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <p class="text-center lead mt-3" id="satus_msg"></p>
                            </span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" name="btnChangePassword" id="btnChangePassword" value="changePassword">Save changes</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
        </div>


    </div>
</div>

<script>
    var showPassword = false;
    function eyeClick(passwordNo){
        var eye = document.getElementById('eye'+passwordNo);
        var password = document.getElementById('txtPassword'+passwordNo);

        if(showPassword == false){
            password.setAttribute('type','text');
            eye.classList.add("fa-eye-slash");
            eye.classList.remove("fa-eye");
            showPassword = true;
        }else{
            password.setAttribute('type','password');
            eye.classList.add("fa-eye");
            eye.classList.remove("fa-eye-slash");
            showPassword = false;
        }
    }   
</script>
<script>
    $(document).ready(function(){
        //change password
        $('#btnChangePassword').click(function(event){
            event.preventDefault();
            var currentPassword = $('#txtPassword1').val();
            var newPassword = $('#txtPassword2').val();
            var conformNewPassword = $('#txtPassword3').val();
            var changePassword = $('#btnChangePassword').val();

            $('#satus_msg').load('user_changePassword.php',{
                currentPassword:currentPassword,
                newPassword:newPassword,
                conformNewPassword:conformNewPassword,
                changePassword:changePassword
            });
        });

        //update user details
        $('#bntUpdate').click(function(event){
            event.preventDefault();
            var firstName = $('#txtFirstName').val();
            var lastName = $('#txtLastName').val();
            var email = $('#txtEmail').val();
            var nic = $('#txtNic').val();
            var address = $('#txtAddress').val();
            var profection = $('#sleProfection').val();
            var password = $('#txtPassword0').val();
            var update = $('#bntUpdate').val();
             
            $('#update_satus_msg').load('user_updateProfileDetails.php',{
                firstName:firstName,
                lastName:lastName,
                email:email,
                nic:nic,
                address:address,
                profection:profection,
                password:password,
                update:update
            });
        });
    });
</script>
<script>
    function backtohome(){
        $('#main').load('user_bookDetails.php');
    }
</script>
<?php mysqli_close($connection);?>
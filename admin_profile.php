<?php session_start(); ?>
<?php require_once('inc/connection.php');?>
<?php
    $updatedPassword="";
    //view admin details
    $adminId = $_SESSION['adminId'];
    //create database query for get admin details
    $query = "SELECT * FROM tbladmin WHERE adminId='$adminId'";
    //excute query
    $excute_query = mysqli_query($connection, $query);

    $admin = mysqli_fetch_assoc($excute_query);
    $currentPassword= base64_encode($admin['password']);
?>
<div class="row justify-content-center">
        <!--Profile Details-->
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 div_admin_profile">
                <div class="d-flex justify-content-center">
                    <p id="subTopic" class="text-primary lead">Admin Profile Details</p>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="" style="background-color: rgb(236, 236, 236,0.5);padding: 20px;border-radius: 10px;">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="txtFullName">Full Name</label>
                                <input type="text" name='fullName' id="txtFullName" class="form-control" aria-describedby="fullname"  maxlength="50" required <?php echo 'value="'.$admin['fullName'].'"';?>>
                            </div>

                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="text" name='email' id="txtEmail" class="form-control" aria-describedby="email"  maxlength="50" required <?php echo 'value="'.$admin['email'].'"';?>>
                            </div>

                            <div class="form-group">
                                <label for="nic">NIC</label>
                                <input type="text" name='nic' id="txtNic" class="form-control" aria-describedby="nic"  maxlength="20" required <?php echo 'value="'.$admin['NIC'].'"';?>>
                            </div>

                            <hr>
                            <label for="" class="text lead" id="subTopic">Conformation</label>
                            <div class="form-group">
                                <label for="txtPassword0">you need to enter your current password to change account details.</label>
                                <input type="password" name='updatedPassword' id="txtPassword0" class="form-control" aria-describedby="password"  maxlength="50" required>
                                <i class="far fa-eye" id="eye0" onclick="eyeClick(0);"></i>
                            </div>

                            <div class="row">
                                <span class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="alert text-center lead mt-3" role="alert" id="update_satus_msg"></div>
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
    <!--change password model-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.7);">
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
                                <div class="alert text-center lead mt-3" role="alert" id="satus_msg"></div>
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
        //admin change password
        $("#btnChangePassword").click(function(event){
            event.preventDefault();
            var currentPassword = $('#txtPassword1').val();
            var newPassword = $('#txtPassword2').val();
            var conformNewPassword = $('#txtPassword3').val();
            var changePassword = $('#btnChangePassword').val();

            $('#satus_msg').load('admin_changePassword.php',{
                currentPassword:currentPassword,
                newPassword:newPassword,
                conformNewPassword:conformNewPassword,
                changePassword:changePassword
            });
        });
        //update admin details
        $('#bntUpdate').click(function(event){
            event.preventDefault();
            var fullName = $('#txtFullName').val();
            var email = $('#txtEmail').val();
            var nic = $('#txtNic').val();;
            var password = $('#txtPassword0').val();
            var update = $('#bntUpdate').val();
            $('#update_satus_msg').load('admin_updateProfileDetails.php',{
                fullName:fullName,
                email:email,
                nic:nic,
                password:password,
                update:update
            });
        });
    });
</script>
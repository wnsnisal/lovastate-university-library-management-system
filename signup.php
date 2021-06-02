            <section class="col-12 col-sm-6 col-md-6">
                <form action="" method="post" id="frmSignUp">
                    <p class="text-center lead">Create a new account</p>
                    <hr>
                    <div class="form-group">
                        <label for="txtFirstName">First name</label>
                        <input name="txtFirstName" type="text" class="form-control" id="txtFirstName" aria-describedby="firstname"  maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="txtLastName">Last name</label>
                        <input id="txtLastName" type="text" class="form-control" id="txtLastName" aria-describedby="lastname" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input name="txtEmail" type="email" class="form-control" id="txtEmail" aria-describedby="emailHelp" maxlength="50" required>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="txtMobileNo">Mobile No</label>
                        <input name="txtMobileNo" type="text" class="form-control" id="txtMobileNo" aria-describedby="moblineno" pattern="[0]{1}[0-9]{9}" required>
                    </div>
                    <div class="form-group">
                        <label for="txtNic">NIC</label>
                        <input name="txtNic" type="text" class="form-control" id="txtNic" aria-describedby="nic" maxlength="20" required>
                    </div>
                    <div class="form-group">
                        <label for="txtAddress">Address or ZIP</label>
                        <input name="txtAddress" type="text" class="form-control" id="txtAddress" aria-describedby="address" maxlength="100" required>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="userType" id="rdoUserType" value="student" checked>
                        <label class="form-check-label" for="inlineRadio1">Student</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="userType" id="rdoUserType" value="profeser">
                        <label class="form-check-label" for="inlineRadio2">Profeser</label>
                    </div>
                    <hr>
                    <p class="text-center lead">Create a new password</p>
                    <div class="form-group">
                        <label for="exampleInputPassword1">New password</label>
                        <input name="txtNewPassword" type="password" class="form-control" id="newPassword">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Conform password</label>
                        <input name="txtConformPassword" type="password" class="form-control" id="conformPassword">
                    </div>
                    <hr>
                    <button name="btnCreateAccount" type="submit" class="btn btn-primary btn-block" id="btnCreateAccount" onclick="matchPassword();">Create Account</button>
                    <p class="text-center lead mt-3" id="satus_msg"></p>
                </form>
            </section>
            <div class="col-12 justify-content-center mt-3 singup">
            <p class="text-center">allrady a member? <a href="" class="singup-link" id="signIn">signin</a> now</p>
            </div>
    <script>
        $("document").ready(function(){
            $("#signIn").click(function(event){
                event.preventDefault();
                $("#form").load("signin.php");
            });
            $("input[type='radio']").click(function(){
                    var userType = $(this).val();
            });
            $("#frmSignUp").submit(function(event){
                event.preventDefault();
                var firstName = $("#txtFirstName").val();
                var lastName = $("#txtLastName").val();
                var email = $("#txtEmail").val();
                var mobileNo = $("#txtMobileNo").val();
                var nic = $("#txtNic").val();
                var address = $("#txtAddress").val();
                var userType = $("#rdoUserType:checked").val();
                var password = $("#conformPassword").val();
                var submit = $("#btnCreateAccount").val();

                $("#satus_msg").load("user_signup.php",{
                    firstName:firstName,
                    lastName:lastName,
                    email:email,
                    mobileNo:mobileNo,
                    nic:nic,
                    address:address,
                    userType:userType,
                    password:password,
                    submit:submit
                });
            });
        });
    </script>

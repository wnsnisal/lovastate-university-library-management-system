
            <section class="col-12 col-sm-6 col-md-4">
                <form action="" method="post" id="frmLogin">
                    <p class="text-center lead">User Loing</p>
                    <hr>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input name="txtEmail_login" id="loginEmail" type="email" class="form-control" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input name="txtPassword_login" id="password" type="password" class="form-control">
                        <i class="far fa-eye" id="eye"></i>
                      </div>
                      <button name="btnLogin"type="submit" class="btn btn-primary btn-block" id="login">Submit</button>
                      <p class="text-center lead" id="satus_msg_login"><?php $error; ?></p>
                </form>
            </section>
            <div class="col-12 justify-content-center mt-3 singup">
            <p class="text-center">not a member? <a href="" class="singup-link" id="signUp">signup</a> now</p>
            </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script>
        $("document").ready(function(){
            $("#signUp").click(function(event){
                event.preventDefault();
                $("#form").load("signup.php");
            });
        });
    </script>
    <!--import javascript files-->
    <script src="inc/script.js"></script>
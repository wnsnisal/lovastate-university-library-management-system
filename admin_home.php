<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dash board</title>
    <!--fontawesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--import css files-->
    <link rel="stylesheet" href="css/admin_home_style.css">
    <link rel="stylesheet" href="css/admin_bookDetails_style.css">
</head>
<body>
        <div class="row bg-dark">
            <div class="col-12">
                <div class="logo mt-3">
                    <img src="img/12.png" alt="">
                    <span class="text text-light logo_name">LOWA STATE UNIVERSITY</span>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li id="tab-li-1" class="nav-item active">
                        <a class="nav-link" id="tabLink-1" onclick="tabContral(1)" href="#">Book Details</a>
                    </li>
                    <li id="tab-li-2" class="nav-item">
                        <a class="nav-link" id="tabLink-2" onclick="tabContral(2)" href="#">User Details</a>
                    </li>
                    <li id="tab-li-3" class="nav-item">
                        <a class="nav-link" id="tabLink-3" onclick="tabContral(3)" href="#">Book Issue Details</a>
                    </li>
                    <li id="tab-li-4" class="nav-item">
                        <a class="nav-link" id="tabLink-4" onclick="tabContral(4)" href="#">Admin Profile</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                <p class="text-right text-secondary">Admin dash board</p>
            </div>
            <a href="logout.php"><button class="btn btn-sm btn-outline-danger" id="btnLogout">Logout</button></a>
        </nav>
    <div class="row">
        <div class="col-12 mt-1">
            <p class="text-right font-weight-lighter text-dark mr-3"><?php echo date("Y-m-d h:i:sa"); ?></p>
        </div>
    </div>
    <div class="container">
        <div id="main" class="mb-3">

        </div>

    </div>
    <!-- Optional JavaScript -->
    <script src="inc/admin_tabContrall_script.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!--import jquery file-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            //when page load
           $("#main").load('admin_bookDetails.php'); 

           //when book details link clicked
           $("#tabLink-1").click(function(){
                $("#main").load('admin_bookDetails.php'); 
           });

           //when user details link clicked
           $("#tabLink-2").click(function(){
                $("#main").load('admin_userDetails.php'); 
           });

           //when book issue details link clicked
           $("#tabLink-3").click(function(){
                $("#main").load('admin_bookIssueDetails.php'); 
           });

           //when book admin profile link clicked
           $("#tabLink-4").click(function(){
                $("#main").load('admin_profile.php'); 
           });
        });
    </script>
    <script>
    var showPassword = false;
    function eyeClick(){
        var eye = document.getElementById('eye');
        var password = document.getElementById('txtPassword');

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
</body>
</html>
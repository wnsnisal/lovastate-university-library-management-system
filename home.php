<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php
    if(!isset($_SESSION['firstName'])){
        //rederect to login page
        header('Location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Home</title>
    <link rel="stylesheet" href="css/home_style.css">
    <!--fontawesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--aditional CSS-->
    <link rel="stylesheet" href="css/user_profileDetails_style.css">
</head>
<body>
<div class="pos-f-t">
    <div class="collapse" id="navbarToggleExternalContent">
    <div class="bg-dark p-4 bg">
        <div class="row">
            <div class="col-12">
                <div class="logo">
                    <img src="img/12.png" alt="">
                    <span class="text logo_name">LOWA STATE UNIVERSITY</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3">

                    <div class="card profile" style="width: 18rem;">
                        <img src="img/profileIcon.png" class="img-circle float-right profile_img" alt="">
                        <div class="card-body">
                            <p class="card-title profile_name"><?php echo $_SESSION['userType'];?></p>
                            <p class="card-text text-uppercase lead username" id="userName"><?php echo $_SESSION['firstName'];?></p>
                            <a href="logout.php"><button class="btn btn-danger" id="btnLogout">Logout</button></a>
                        </div>
                    </div>

            </div>
        </div>  
        </div>
    </div>
    </div>
  <nav class="navbar navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class=""><i class="fas fa-user"></i></span>
    </button>
  </nav>
</div>
<!--main container-->
<div class="container bg_body" id="main" style="padding-top:5px;padding-bottom:10px;">

</div>
<!--footer-->
<div class="footer bg-dark">
    <p class=" text-light font-weight-lighter text-center mt-3">Contact Us</p>
    <p class=" text-light font-weight-lighter text-center">+94 11 2698847</p>
    <p class=" text-light font-weight-lighter text-center">
        Lowa state univercity<br>
        Main library<br>
        No 14, Independence Avenue,<br>
        Colombo 07,<br>
        Sri Lanka.<br>
    </p>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- inport jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#main").load("user_bookDetails.php");

            $('#userName').click(function(){
                $('#main').load('user_profileDetails.php');
            });  
            
        });
    </script>
</body>
</html>
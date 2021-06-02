<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php

    //user login mekanisme
    if(isset($_POST['btnLogin'])){
        $email = mysqli_real_escape_string($connection, $_POST['txtEmail_login']);
        $password = mysqli_real_escape_string($connection, $_POST['txtPassword_login']);
        //encript the password user typed
        $encoded_password = base64_encode($password);
        //prepare database queryes
        $user_query = "SELECT * FROM tbluser WHERE email = '$email' AND password='$encoded_password' LIMIT 1";
        $admin_query = "SELECT * FROM tbladmin WHERE email = '$email' LIMIT 1";
        //excute quires
        $excute_user_query = mysqli_query($connection, $user_query);
        $excute_admin_query = mysqli_query($connection, $admin_query);

        

        if($excute_user_query || $excute_admin_query){
            if(mysqli_num_rows($excute_user_query)==1){
                //stor user details to a varibale
                $user = mysqli_fetch_assoc($excute_user_query);
                //pass first name and user type to session variable
                $_SESSION['firstName'] = $user['firstName'];
                $_SESSION['userType'] = $user['userType'];
                $_SESSION['userId'] = $user['userId'];
                //rederect to the home page
                header('Location: home.php');
            }else{
                if(mysqli_num_rows($excute_admin_query)==1){
                    //stor admin details to a varibale
                    $admin = mysqli_fetch_assoc($excute_admin_query);
                    //pass full name to session variable
                    $_SESSION['fullName'] = $admin['fullName'];
                    $_SESSION['adminId'] = $admin['adminId'];
                    //rederect to the admin page
                    header('Location: admin_home.php');
                }else{
                    //if not show error massage
                    
                    //echo '<div class="alert alert-danger" role="alert">invalied email and pasword!</div>';
                    echo "<script>alert('invalied email and pasword!');</script>";

                }
            }
        }else{
           //echo '<div class="alert alert-danger" role="alert">database query error!</div>';
           echo "<script>alert('database query error!');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--fontawesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Login</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <section class="container-fluid bg">
        <div class="row justify-content-center">
            <img src="img/12.png" alt="" width="100px">
        </div>
        <div class="row justify-content-center">
            <h1 class="text-center">LOWA STATE UNIVERSITY</h1>
        </div>
        <div class="row justify-content-center">
            <p class="text-center lead topic">Online library</p>
        </div>
        <section class="row justify-content-center" id="form">
            
        </section>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!--import jquery file-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script>
        $("document").ready(function(){
            $("#form").load("signin.php");

        });

    </script>
</body>
</html>
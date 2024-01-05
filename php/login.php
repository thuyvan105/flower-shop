<?php
require "funLogin.php";

// ktr biến phiên ss id đã đc đặt chưa(cd: save tt nhân qua các page & phiên)
// if(isset($_SESSION["id_user"]) && $_SESSION["role"] == 0){
//   // nếu biến phiên id đã đc đặt thì user đa login =>index
//   header("Location: index.php");
// } else if ($_SESSION["role"] == 1) {
//   header('location: admin/index.php');
// }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in & Sign up Form</title>

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Leckerli+One&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" 
    integrity="sha384-ez1Ly8ZI+6Fz1PFSzH3Z+U5jt1GQ2a9LGzY+//Su8Q57bI0DTXnt9T4jKJpWSo9g" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/login.css" />


    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <!-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

  </head>
  <body>
    <main>
      <div class="box">
        <div class="inner-box">
          <div class="forms-wrap">

          <form action="funLogin.php" autocomplete="off" class="sign-in-form" method="post">
          <input type="hidden" name="action" id="login-action" value="login">

              <div class="logo">
                <!-- <i class="fa-brands fa-pagelines" style="color: black; font-size: 22px; margin-right: 7px;"></i> -->
                <a href="index.php" style="text-decoration: none; font-stretch: ultra-expanded; letter-spacing: 5px;color:red; font-size:25px;">
                BLU<span style="color:black;  font-stretch: ultra-expanded; letter-spacing: 3px; font-size:25px;">ME</span></a>
              </div>

              <div class="heading">
                <h2>Welcome to BLUME</h2>
                <h6>Don't have an account yet?</h6>
                <a href="#" class="toggle">Register</a>
              </div>

              <div class="actual-form">
                <div class="input-wrap">
                <input type="email" minlength="4" class="input-field" id="login-email" value="" name="email"  required>    
                  <label>Email</label>
                </div>

                <div class="input-wrap">
                <input type="password" minlength="4" class="input-field" id="login-password" value="" name="password"  required>
                  <label>Mật khẩu</label>
                </div>

                <input type="submit" value="Login" class="sign-btn" onclick="submitLoginData()">

                <p class="text">
                  Forgotten your password or you login datails?
                  <a href="#">Get help</a> signing in
                </p>
              </div>
            </form>




            <form action="" autocomplete="off" class="sign-up-form" method="post">
            <input type="hidden" id="register-action" value="register">

              <div class="logo">
                <a href="index.php" style="text-decoration: none; font-stretch: ultra-expanded; letter-spacing: 5px;color:red; font-size:25px;">
                BLU<span style="color:black;  font-stretch: ultra-expanded; letter-spacing: 3px; font-size:25px;">ME</span></a>
              </div>

              <div class="heading">
                <h2>Register</h2>
                <h6>Already have an account?</h6>
                <a href="#" class="toggle">Login</a>
              </div>
              <div class="actual-form"> 
                <div class="input-wrap">
                <input type="text" minlength="4" class="input-field" id="register-name" value="" required>
                  <label>Username</label>
                </div>

                <div class="input-wrap">
                <input type="email" class="input-field" id="register-email" value="" required>
                  <label>Email</label>
<br> <br>               <p id = "nhacloitrung"></p>

                </div>

                <div class="input-wrap">
                <input type="password" minlength="4" class="input-field" id="register-password" value="" required>
                  <label>Password</label>
                </div>

                <input type="submit" value="Register" class="sign-btn" onclick="submitRegisterData()">

                <p class="text">
                  By signing up, I agree to the
                  <a href="#">Terms of Services</a> and
                  <a href="#">Privacy Policy</a>
                </p>
              </div>
            </form>
          </div>

          <div class="carousel">
            <div class="images-wrapper">
              <img src="../img/ha5.jpg" class="image img-1 show" alt="" />
              <img src="../img/ha2.jpg" class="image img-2" alt="" />
              <img src="../admin/img/new2.jpg" class="image img-3" alt="" />
            </div>

            <div class="text-slider">
              <div class="text-wrap">
                <div class="text-group">
                  <h2>Create your own courses</h2>
                  <h2>Customize as you like</h2>
                  <h2>Invite students to your class</h2>
                </div>
              </div>

              <div class="bullets">
                <span class="active" data-value="1"></span>
                <span data-value="2"></span>
                <span data-value="3"></span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php require 'scLogin.php'; ?>

    </main>
    <!-- Javascript file -->
    <script src="../app.js"></script>
  </body>
</html>

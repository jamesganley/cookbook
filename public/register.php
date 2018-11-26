<?php
//Reference-https://codewithawa.com/posts/complete-user-registration-system-using-php-and-mysql-database
//Youtube-Tutorial-https://www.youtube.com/watch?v=C--mu07uhQw
session_start();// Cool
include_once __DIR__ . "/../database.php";

$username = "";
$email    = "";
$errors = array();
$_SESSION['success'] = "";


if (isset($_SERVER['REQUEST_METHOD'] == "POST") {
 // receive all input values from the form
 $username =mysqli_real_escape_string ($db, $_POST['username']);
 $email = mysqli_real_escape_string($db, $_POST['email']);
 $password_1 =mysqli_real_escape_string ($db, $_POST['password_1']);
 $password_2 = mysqli_real_escape_string($db,$_POST['password_2']);
 // form validation: ensure that the form is correctly filled
 if (empty($username)) { array_push($errors, "Username is required"); }
 if (empty($email)) { array_push($errors, "Email is required"); }
 if (empty($password_1)) { array_push($errors, "Password is required"); }
 if ($password_1 != $password_2) {
   array_push($errors, "The two passwords do not match");
 }
 // register user if there are no errors in the form
 if (count($errors) == 0) {
   $password = md5($password_1);//encrypt the password before saving in the database
   $query = "INSERT INTO users (username, email, password)
         VALUES('$username', '$email', '$password')";
   $db->query($query);
   $reg_user_id = mysqli_insert_id($db);
   $_SESSION['username'] = $username;
   $_SESSION['success'] = "You are now logged in";
   header('location: index.php');
 }
}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/formstyle.css">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="post" id="signup-form" class="signup-form" action="register.php">
                      <?php if (count($errors) > 0) {
                        echo "Error Registering";
                      } ?>
                      <?php include('errors.php'); ?>
                        <h2 class="form-title">Create account</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="username" id="name" placeholder="Username"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="password_1" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password_2" id="re_password" placeholder="Repeat your password"/>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="reg_user" id="submit" class="form-submit" value="Sign up"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="login.php" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/register.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>

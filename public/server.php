<?php
//Reference-https://codewithawa.com/posts/complete-user-registration-system-using-php-and-mysql-database
//Youtube-Tutorial-https://www.youtube.com/watch?v=C--mu07uhQw
session_start();
include_once __DIR__ . "/../database.php";

$username = "";
$email    = "";
$errors = array();
$_SESSION['success'] = "";

// REGISTER USER
if (isset($_POST['reg_user'])) {
	// receive all input values from the form
	$username =mysqli_real_escape_string ($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password_1 =mysqli_real_escape_string ($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string$db,( $_POST['password_2']);
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
		$_SESSION['username'] = $username;
		$_SESSION['success'] = "You are now logged in";
		header('location: index.php');
	}
}
	// LOGIN USER
	if (isset($_POST['login_user'])) {
		$username = mysqli_real_escape_string($db,$_POST['username']);
		$password = mysqli_real_escape_string($db,$_POST['password']);
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}
		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results=$db->query($query);
			if (count($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "The account name or password that you have entered is incorrect.");
			}
		}
	}
?>

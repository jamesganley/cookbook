<?php
	session_start();
  $host = 'localhost';
  $dbname   = 'crud';
  $user = 'root';
  $pass = '';
  $charset = 'utf8mb4';

  $conn = mysqli_connect($host, $user, $pass, $dbname);

	// initialize variables
	$name = "";
	$address = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$address = $_POST['address'];

    $result1="INSERT INTO crud (name, address) VALUES ('$name', '$address')";
		// mysqli_query($db,$result1 );
    $conn->query($result1);
    var_dump($result1);
		$_SESSION['message'] = "Address saved";
		header('location: crud.php');
	}

// ...

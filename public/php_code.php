<?php

	// initialize variables
	$item = "";
	$quantity = 0;
	$id = 0;
  $expiry = "";
	$update = false;


	if (isset($_POST['save'])){
    additem();  }

  function additem() {
    global $db;
		$item = $_POST['item'];
		$quantity = $_POST['quantity'];
    $expiry = $_POST['expiry'];

  	// Author can only view their posts
  	$user_id = $_SESSION['user_id'];
    $result1="INSERT INTO crud (user_id, item, quantity, expiry) VALUES ('$user_id', '$item', '$quantity', '$expiry')";
		mysqli_query($db,$result1 );
    $db->query($result1);var_dump($result1);
    die();
		$_SESSION['message'] = "Address saved";
		header('location: about.php');
	}

  if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$address = $_POST['address'];

	mysqli_query($db, "UPDATE crud SET name='$name', address='$address' WHERE id=$id");
	$_SESSION['message'] = "Address updated!";
	header('location: upload.php');
}

if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM crud WHERE id=$id");
	$_SESSION['message'] = "Address deleted!";
	header('location: upload.php');
}


// ...

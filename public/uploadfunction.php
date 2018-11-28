<?php



// initialize variables
$item = "";
$quantity = 0;
$id = 0;
$expiry = "";
$update = false;


if (isset($_POST['save'])){
  global $db;
  $item = $_POST['item'];
  $quantity = $_POST['quantity'];
  $expiry = $_POST['expiry'];

  // Author can only view their posts
  $user_id = $_SESSION['user_id'];
  $result1="INSERT INTO crud (user_id, item, quantity, expiry) VALUES ('$user_id', '$item', '$quantity', '$expiry')";
  $db->query($result1);
  $_SESSION['message'] = "Address saved";
  header('location: about.php');
}

if (isset($_POST['update'])) {
$user_id = $_SESSION['user_id'];
$id = $_POST['id'];
$item = $_POST['item'];
$quantity = $_POST['quantity'];
$expiry = $_POST['expiry'];

mysqli_query($db, "UPDATE crud SET item='$item', quantity='$quantity', expiry='$expiry' WHERE id=$id");
$_SESSION['message'] = "Address updated!";
header('location: about.php');
}

if (isset($_GET['del'])) {
$id = $_GET['del'];
mysqli_query($db, "DELETE FROM crud WHERE id=$id");
$_SESSION['message'] = "Address deleted!";
header('location: about.php');
}
?>

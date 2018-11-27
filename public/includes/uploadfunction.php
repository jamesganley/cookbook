<?php
// Post variables
$post_id = 0;
$isEditingPost = false;
$published = 0;
$title = "";
$post_slug = "";
$body = "";
$featured_image = "";
$post_topic = "";
/* - - - - - - - - - -
-  Post functions
- - - - - - - - - - -*/
// get all posts from DB


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
  $db->query($result1);
  die();
  $_SESSION['message'] = "Address saved";
  header('location: about.php');
}
function getAllPosts()
{
	global $db;

	// Admin can view all posts
	// Author can only view their posts
	$user_id = $_SESSION['user_id'];

	$sql = "SELECT * FROM posts WHERE user_id=${user_id}";
	$result = mysqli_query($db, $sql);

	if (!$result) {
		return false;
	}

	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_posts = array();

	foreach ($posts as $post) {
		$post['author'] = getPostAuthorById($post['user_id']);
		array_push($final_posts, $post);
	}
	return $final_posts;
}

?>

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
require '../vendor/autoload.php';
use Aws\S3\S3Client;
					use Aws\S3\Exception\S3Exception;
/* - - - - - - - - - -
-  Post functions
- - - - - - - - - - -*/
// get all posts from DB
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
// get the author/username of a post
function getPostAuthorById($user_id)
{
	global $db;
	$sql = "SELECT username FROM users WHERE id=$user_id";
	$result = mysqli_query($db, $sql);
	if ($result) {
		// return username
		return mysqli_fetch_assoc($result)['username'];
	} else {
		return null;
	}
}

/* - - - - - - - - - -
-  Post actions
- - - - - - - - - - -*/
// if user clicks the create post button
if (isset($_POST['create_post'])) { createPost($_POST); }
// if user clicks the Edit post button
if (isset($_GET['edit-post'])) {
	$isEditingPost = true;
	$post_id = $_GET['edit-post'];
	editPost($post_id);
}
// if user clicks the update post button
if (isset($_POST['update_post'])) {
	updatePost($_POST);
}
// if user clicks the Delete post button
if (isset($_GET['delete-post'])) {
	$post_id = $_GET['delete-post'];
	deletePost($post_id);
}

/* - - - - - - - - - -
-  Post functions
- - - - - - - - - - -*/
function createPost($request_values)
	{
		global $db, $errors, $title, $featured_image, $topic_id, $body, $published;

		$user_id = $_SESSION['user_id'];
		$title = esc($request_values['title']);
		$body = htmlentities(esc($request_values['body']));

		if (isset($request_values['topic_id'])) {
			$topic_id = esc($request_values['topic_id']);
		}
		if (isset($request_values['publish'])) {
			$published = esc($request_values['publish']);
		}
		// create slug: if title is "The Storm Is Over", return "the-storm-is-over" as slug
		$post_slug = makeSlug($title);

		// validate form
		if (empty($title)) { array_push($errors, "Post title is required"); }
		if (empty($body)) { array_push($errors, "Post body is required"); }
		if (empty($topic_id)) { array_push($errors, "Post topic is required"); }

		// Get image name
	  	$featured_image = $_FILES['featured_image']['name'];
	  	if (empty($featured_image)) { array_push($errors, "Featured image is required"); }
	  	// image file directory
	  	$target = $_SERVER["DOCUMENT_ROOT"] . "/static/images/" . basename($featured_image);

	  	if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
	  		array_push($errors, "Failed to upload image. Please check file settings for your server");
	  	}
		// Ensure that no post is saved twice.
		$post_check_query = "SELECT * FROM posts WHERE slug='$post_slug' LIMIT 1";
		$result = mysqli_query($db, $post_check_query);

		if (mysqli_num_rows($result) > 0) { // if post exists
			array_push($errors, "A post already exists with that title.");
		}
		// create post if there are no errors in the form
		if (count($errors) == 0) {

			$now = date('Y/m/d');
			$user_id = $_SESSION["user_id"];
			var_dump($_SESSION);
			$query = "INSERT INTO posts (user_id, title, slug, image, body, published, created_at, updated_at)
			VALUES('${user_id}', '${title}', '${post_slug}', '${featured_image}', '${body}', '${published}', '${now}', '${now}')";

			echo $query;
			if(mysqli_query($db, $query)){ // if post created successfully
				echo "creating post";
				$inserted_post_id = mysqli_insert_id($db);
				// create relationship between post and topic
				$sql = "INSERT INTO post_topic (post_id, topic_id) VALUES($inserted_post_id, $topic_id)";
				mysqli_query($db, $sql);

				$_SESSION['message'] = "Post created successfully";
				header('location: posts.php');
				exit(0);
			}
		}
		var_dump($errors);
			uploadaws();
	}

	function uploadaws(){

		        		$bucketName = 'cookbook-strawberry';
			        	$IAM_KEY = 'AKIAIPEP6LNO77KYTAFA';
			        	$IAM_SECRET = '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';
			        	// Connect to AWS
			        	try {
			        		// You may need to change the region. It will say in the URL when the bucket is open
			        		// and on creation.
			        		$s3 = S3Client::factory(
			        			array(
			        				'credentials' => array(
			        					'key' => $IAM_KEY,
			        					'secret' => $IAM_SECRET
			        				),
			        				'version' => 'latest',
			        				'region'  => 'eu-west-1'
			        			)
			        		);
			        	} catch (Exception $e) {
			        		// We use a die, so if this fails. It stops here. Typically this is a REST call so this would
			        		// return a json object.
			        		die("Error:0 " . $e->getMessage());
			        	}

			        	// For this, I would generate a unqiue random string for the key name. But you can do whatever.
			        	$keyName = "images/" . basename($_FILES["featured_image"]['name']);
			        	$pathInS3 = 'https://s3.eu-west-1.amazonaws.com/' . $bucketName . '/' . $keyName;
			        	// Add it to S3
			        	try {
			        		// Uploaded:
			            $target_dir= $_SERVER["DOCUMENT_ROOT"] . "/static/images/";

			        		$file = $target_dir.basename( $_FILES["featured_image"]['name']);
			        		$s3->putObject(
			        			array(
			        				'Bucket'=>$bucketName,
			        				'Key' =>  $keyName,
			        				'SourceFile' => $file,
			        				'StorageClass' => 'REDUCED_REDUNDANCY'
			        			)
			        		);
			        	} catch (S3Exception $e) {
			        		die('Error:1' . $e->getMessage());
			        	} catch (Exception $e) {
			        		die('Error:2' . $e->getMessage());
			        	}
			        	echo 'Done uploading ';
		        	// Now that you have it working, I recommend adding some checks on the files.
		        	// Example: Max size, allowed file types, etc.
	}

	/* * * * * * * * * * * * * * * * * * * * *
	* - Takes post id as parameter
	* - Fetches the post from database
	* - sets post fields on form for editing
	* * * * * * * * * * * * * * * * * * * * * */
	function editPost($role_id)
	{
		global $db, $title, $post_slug, $body, $published, $isEditingPost, $post_id;
		$sql = "SELECT * FROM posts WHERE id=$role_id LIMIT 1";
		$result = mysqli_query($db, $sql);
		$post = mysqli_fetch_assoc($result);
		// set form values on the form to be updated
		$title = $post['title'];
		$body = $post['body'];
		$published = $post['published'];
	}

	function updatePost($request_values)
	{
		global $db, $errors, $post_id, $title, $featured_image, $topic_id, $body, $published;

		$title = esc($request_values['title']);
		$body = esc($request_values['body']);
		$post_id = esc($request_values['post_id']);
		if (isset($request_values['topic_id'])) {
			$topic_id = esc($request_values['topic_id']);
		}
		if (isset($request_values['publish'])) {
			$published = esc($request_values['publish']);
		}

		// create slug: if title is "The Storm Is Over", return "the-storm-is-over" as slug
		$post_slug = makeSlug($title);

		if (empty($title)) { array_push($errors, "Post title is required"); }
		if (empty($body)) { array_push($errors, "Post body is required"); }
		// if new featured image has been provided
		if (isset($_POST['featured_image'])) {
			// Get image name
		  	$featured_image = $_FILES['featured_image']['name'];
		  	// image file directory
		  	$target =  $_SERVER["DOCUMENT_ROOT"] . "/static/images/" . basename($featured_image);
		  	if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
		  		array_push($errors, "Failed to upload image. Please check file settings for your server");
		  	}
		}

		// register topic if there are no errors in the form
		if (count($errors) == 0) {
			$query = "UPDATE posts SET title='$title', slug='$post_slug', image='$featured_image', body='$body', published=$published, updated_at=now() WHERE id=$post_id";
			// attach topic to post on post_topic table
			if(mysqli_query($db, $query)){ // if post created successfully
				if (isset($topic_id)) {
					$inserted_post_id = mysqli_insert_id($db);
					// create relationship between post and topic
					$sql = "INSERT INTO post_topic (post_id, topic_id) VALUES($inserted_post_id, $topic_id)";
					mysqli_query($db, $sql);
					$_SESSION['message'] = "Post created successfully";
					header('location: posts.php');
					exit(0);
				}
			}
			$_SESSION['message'] = "Post updated successfully";
			header('location: posts.php');
			exit(0);
		}
	}
	// delete blog post
	function deletePost($post_id)
	{
		global $db;
		$sql = "DELETE FROM posts WHERE id=$post_id";
		if (mysqli_query($db, $sql)) {
			$_SESSION['message'] = "Post successfully deleted";
			header("location: posts.php");
			exit(0);
		}
	}
  // if user clicks the publish post button
if (isset($_GET['publish']) || isset($_GET['unpublish'])) {
	$message = "";
	if (isset($_GET['publish'])) {
		$message = "Post published successfully";
		$post_id = $_GET['publish'];
	} else if (isset($_GET['unpublish'])) {
		$message = "Post successfully unpublished";
		$post_id = $_GET['unpublish'];
	}
	togglePublishPost($post_id, $message);
}
// delete blog post
function togglePublishPost($post_id, $message)
{
	global $db;
	$sql = "UPDATE posts SET published=!published WHERE id=$post_id";

	if (mysqli_query($db, $sql)) {
		$_SESSION['message'] = $message;
		header("location: posts.php");
		exit(0);
	}
}
?>

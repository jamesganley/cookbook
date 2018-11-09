<?php
/* * * * * * * * * * * * * * *
* Returns all published posts
* * * * * * * * * * * * * * */

function getPublishedPosts() {
	// use global $db object in function
	global $db;
	$sql = "SELECT * FROM posts WHERE published=true";
	$result = mysqli_query($db, $sql);
	// fetch all posts as an associative array called $posts
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_posts = array();
	foreach ($posts as $post) {
		$post['topic'] = getPostTopic($post['id']);
		array_push($final_posts, $post);
	}
	return $final_posts;
}
/* * * * * * * * * * * * * * *
* Receives a post id and
* Returns topic of the post
* * * * * * * * * * * * * * */
function getPostTopic($post_id){
	global $db;
	$sql = "SELECT * FROM topics WHERE id=
			(SELECT topic_id FROM post_topic WHERE post_id=$post_id) LIMIT 1";
	$result = mysqli_query($db, $sql);
	$topic = mysqli_fetch_assoc($result);
	return $topic;
}
// more functions to come here ...
/* * * * * * * * * * * * * * * *
* Returns all posts under a topic
* * * * * * * * * * * * * * * * */
function getPublishedPostsByTopic($topic_id) {
	global $db;
	$sql = "SELECT * FROM posts ps
			WHERE ps.id IN
			(SELECT pt.post_id FROM post_topic pt
				WHERE pt.topic_id=$topic_id GROUP BY pt.post_id
				HAVING COUNT(1) = 1)";
	$result = mysqli_query($db, $sql);
	// fetch all posts as an associative array called $posts
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_posts = array();
	foreach ($posts as $post) {
		$post['topic'] = getPostTopic($post['id']);
		array_push($final_posts, $post);
	}
	return $final_posts;
}
/* * * * * * * * * * * * * * * *
* Returns topic name by topic id
* * * * * * * * * * * * * * * * */
function getTopicNameById($id)
{
	global $db;
	$sql = "SELECT name FROM topics WHERE id=$id";
	$result = mysqli_query($db, $sql);
	$topic = mysqli_fetch_assoc($result);
	return $topic['name'];
}

/* * * * * * * * * * * * * * *
* Returns a single post
* * * * * * * * * * * * * * */
function getPost($slug){
	global $db;
	// Get single post slug
	$post_slug = $_GET['post-slug'];
	$sql = "SELECT * FROM posts WHERE slug='$post_slug' AND published=true";
	$result = mysqli_query($db, $sql);

	// fetch query results as associative array.
	$post = mysqli_fetch_assoc($result);
	if ($post) {
		// get the topic to which this post belongs
		$post['topic'] = getPostTopic($post['id']);
	}
	return $post;
}
/* * * * * * * * * * * *
*  Returns all topics
* * * * * * * * * * * * */
function getAllTopics()
{
	global $db;
	$sql = "SELECT * FROM topics";
	$result = mysqli_query($db, $sql);
	$topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $topics;
}
?>
<?php
// Admin user variables
// ... varaibles here ...

// Topics variables
$topic_id = 0;
$isEditingTopic = false;
$topic_name = "";

/* - - - - - - - - - -
-  Admin users actions
- - - - - - - - - - -*/
// ...

/* - - - - - - - - - -
-  Topic actions
- - - - - - - - - - -*/
// if user clicks the create topic button
if (isset($_POST['create_topic'])) { createTopic($_POST); }
// if user clicks the Edit topic button
if (isset($_GET['edit-topic'])) {
	$isEditingTopic = true;
	$topic_id = $_GET['edit-topic'];
	editTopic($topic_id);
}
// if user clicks the update topic button
if (isset($_POST['update_topic'])) {
	updateTopic($_POST);
}
// if user clicks the Delete topic button
if (isset($_GET['delete-topic'])) {
	$topic_id = $_GET['delete-topic'];
	deleteTopic($topic_id);
}


/* - - - - - - - - - - - -
-  Admin users functions
- - - - - - - - - - - - -*/
// ...

/* - - - - - - - - - -
-  Topics functions
- - - - - - - - - - -*/
// get all topics from DB
function getAlluserTopics() {
	global $db;
	$sql = "SELECT * FROM topics";
	$result = mysqli_query($db, $sql);
	$topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $topics;
}
function createTopic($request_values){
	global $db, $errors, $topic_name;
	$topic_name = esc($request_values['topic_name']);
	// create slug: if topic is "Life Advice", return "life-advice" as slug
	$topic_slug = makeSlug($topic_name);
	// validate form
	if (empty($topic_name)) {
		array_push($errors, "Topic name required");
	}
	// Ensure that no topic is saved twice.
	$topic_check_query = "SELECT * FROM topics WHERE slug='$topic_slug' LIMIT 1";
	$result = mysqli_query($db, $topic_check_query);
	if (mysqli_num_rows($result) > 0) { // if topic exists
		array_push($errors, "Topic already exists");
	}
	// register topic if there are no errors in the form
	if (count($errors) == 0) {
		$query = "INSERT INTO topics (name, slug)
				  VALUES('$topic_name', '$topic_slug')";
		mysqli_query($db, $query);

		$_SESSION['message'] = "Topic created successfully";
		header('location: topics.php');
		exit(0);
	}
}
/* * * * * * * * * * * * * * * * * * * * *
* - Takes topic id as parameter
* - Fetches the topic from database
* - sets topic fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editTopic($topic_id) {
	global $db, $topic_name, $isEditingTopic, $topic_id;
	$sql = "SELECT * FROM topics WHERE id=$topic_id LIMIT 1";
	$result = mysqli_query($db, $sql);
	$topic = mysqli_fetch_assoc($result);
	// set form values ($topic_name) on the form to be updated
	$topic_name = $topic['name'];
}
function updateTopic($request_values) {
	global $db, $errors, $topic_name, $topic_id;
	$topic_name = esc($request_values['topic_name']);
	$topic_id = esc($request_values['topic_id']);
	// create slug: if topic is "Life Advice", return "life-advice" as slug
	$topic_slug = makeSlug($topic_name);
	// validate form
	if (empty($topic_name)) {
		array_push($errors, "Topic name required");
	}
	// register topic if there are no errors in the form
	if (count($errors) == 0) {
		$query = "UPDATE topics SET name='$topic_name', slug='$topic_slug' WHERE id=$topic_id";
		mysqli_query($db, $query);

		$_SESSION['message'] = "Topic updated successfully";
		header('location: topics.php');
		exit(0);
	}
}
// delete topic
function deleteTopic($topic_id) {
	global $db;
	$sql = "DELETE FROM topics WHERE id=$topic_id";
	if (mysqli_query($db, $sql)) {
		$_SESSION['message'] = "Topic successfully deleted";
		header("location: topics.php");
		exit(0);
	}
}

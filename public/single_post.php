<?php
  session_start();

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: home.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<?php include_once __DIR__ . '/../inc/header.php'; ?>
<?php include __DIR__ . "/../database.php"; ?>
<?php include('includes/public_functions.php'); ?>
<?php
	if (isset($_GET['post-slug'])) {
		$post = getPost($_GET['post-slug']);
	}
?>

<body>

	<div class="container con1 content" >
		<!-- Page wrapper -->
		<div class="post-wrapper">
			<!-- full post div -->
			<div class="full-post-div">
			<?php if ($post['published'] == false): ?>
				<h2 class="post-title">Sorry... This post has not been published</h2>
			<?php else: ?>
				<h2 class="post-title"><?php echo $post['title']; ?></h2>
				<div class="post-body-div">
					<img src="<?php echo 'static/images/' . $post['image']; ?>" class="post_image" alt="">
					<?php echo html_entity_decode($post['body']); ?>
				</div>
			<?php endif ?>
			</div>
			<!-- // full post div -->

			<!-- comments section -->
			<!--  coming soon ...  -->
		</div>
		<!-- // Page wrapper -->

	</div>

<!-- Footer -->
	<?php include_once __DIR__ . "/../inc/footer.php" ?>
<!-- // Footer -->

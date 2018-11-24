<?php
/*Dashboard to create reda update and delete posts*/
  session_start();

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: home.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: home.php");
  }
?>
<?php include_once __DIR__ . '/../inc/header.php'; ?>
<?php include __DIR__ . "/../database.php"; ?>
	<?php include 'includes/public_functions.php' ?>
  <?php $posts = getPublishedPosts(); ?>
<body>
    <section class="recipes-section spad pt-0">
  		<div class="container">
  			<div class="section-title">
  				<h2>Latest recipes</h2>
  			</div>

  			<?php foreach ($posts as $post): ?>
  				<div class>
  					<div class="post" style="margin-left: 0px;">
  					<div class="recipe">
  						<img src="<?php echo 'static/images/' . $post['image']; ?>" class="post_image" alt="">

  						<a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
  						<div class="recipe-info-warp">
  							<div class="recipe-info">
  								<h3><?php echo $post['title'] ?></h3>
  								<div class="info">
  									<span class="read_more">Read more...</span>

  								</div>
  							</div>
  						</div>
  						</a>
  					</div>
  				</div>
  				<?php endforeach ?>
  			</div>
  	</section>
</body>
</html>

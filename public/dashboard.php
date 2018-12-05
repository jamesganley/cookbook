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
	<?php include 'includes/admin_functions.php' ?>
  <?php $posts = getPublishedPosts(); ?>
<body>
  <div class="container">
    <div class="section-title">
      <h2>Your Feed</h2>
    </div>
    <div class="row">
      <?php foreach ($posts as $post): ?>
        <div class="col-lg-4">
          <div class="sp-blog-item">
            <div class="blog-thubm parent">
              <img src="<?php echo 'static/images/' . $post['image']; ?>" alt="">
            </div>
            <div class="blog-text">
              <span><?php echo $post['title']; ?></span>
              <a href="single_post.php?post-slug=<?php echo $post['slug']; ?>" class="readmore"><i class="fa fa-angle-right"></i></a>
            </div>
          </div>
        </div>
    <?php endforeach ?>
    </div>
  </div>
</body>
<!-- Review section end -->
<?php include_once __DIR__ . "/../inc/footer.php" ?>

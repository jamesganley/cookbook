<?php
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

	<!-- Header section end -->


	<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<div class="hero-slide-item set-bg" data-setbg="img/slider-bg-1.jpg">
				<div class="hs-text">
					<h2 class="hs-title-1"><span>Healthy Recipes</span></h2>
					<h2 class="hs-title-2"><span>from the best chefs</span></h2>
					<h2 class="hs-title-3"><span>for all the foodies</span></h2>
				</div>
			</div>
			<div class="hero-slide-item set-bg" data-setbg="img/slider-bg-2.jpg">
				<div class="hs-text">
					<h2 class="hs-title-1"><span>Healthy Recipes</span></h2>
					<h2 class="hs-title-2"><span>from the best chefs</span></h2>
					<h2 class="hs-title-3"><span>for all the foodies</span></h2>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->


	<!-- Add section end -->
	<section class="add-section spad">
		<div class="container">
			<div class="add-warp">
				<div class="add-slider owl-carousel">
					<div class="as-item set-bg" data-setbg="img/add/1.jpg"></div>
					<div class="as-item set-bg" data-setbg="img/add/2.jpg"></div>
					<div class="as-item set-bg" data-setbg="img/add/3.jpg"></div>
				</div>
				<div class="row add-text-warp">
					<div class="col-lg-4 col-md-5 offset-lg-8 offset-md-7">
						<div class="add-text text-white">
							<div class="at-style"></div>
							<h2>Amazing deserts</h2>
							<ul>
								<li>Easy to make</li>
								<li>Step by Step Video Tutorial</li>
								<li>Gluten Free</li>
								<li>Healty  Ingredients</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Add section end -->

	<!-- Recipes section end -->
  <!-- Recipes section -->
  <div class="container">
    <div class="section-title">
      <h2>Latest Community Recipes</h2>
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

	<?php include_once __DIR__ . "/../inc/footer.php" ?>

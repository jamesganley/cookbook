
<?php include 'mainheader.php'; ?>
<?php include __DIR__ . "/../database.php"; ?>
<?php include_once 'includes/public_functions.php' ?>

<!-- Retrieve all posts from database  -->
<?php $posts = getPublishedPosts(); ?>
	<!-- Header section end -->


	<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<div class="hero-slide-item set-bg" data-setbg="img/slider-bg-1.jpg">
				<div class="hs-text">
					<h2 class="hs-title-1"><span>Please log in</span></h2>
					<h2 class="hs-title-2"><span>to access</span></h2>
					<h2 class="hs-title-3"><span>Our Full Website</span></h2>
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
	<!--Community Recipes section -->

		<div class="container">
			<div class="section-title">
				<h2>Latest recipes</h2>
			</div>
<div class="row">
			<?php foreach ($posts as $post): ?>

					<div class="col-md-6">
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
			</div>
			<?php endforeach ?>
			</div>
</div>
	<!-- Recipes section end -->


	<!-- Footer widgets section -->
	<section class="bottom-widgets-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 ftw-warp">
					<div class="section-title">
						<h3>Top rated recipes</h3>
					</div>
					<ul class="sp-recipes-list">
						<li>
							<div class="rl-thumb set-bg" data-setbg="img/thumb/1.jpg"></div>
							<div class="rl-info">
								<span>March 14, 2018</span>
								<h6>Italian pasta</h6>
								<div class="rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star is-fade"></i>
								</div>
							</div>
						</li>
						<li>
							<div class="rl-thumb set-bg" data-setbg="img/thumb/2.jpg"></div>
							<div class="rl-info">
								<span>March 14, 2018</span>
								<h6>French Onion Soup</h6>
								<div class="rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star is-fade"></i>
								</div>
							</div>
						</li>
						<li>
							<div class="rl-thumb set-bg" data-setbg="img/thumb/3.jpg"></div>
							<div class="rl-info">
								<span>March 14, 2018</span>
								<h6>Homemade  pasta</h6>
								<div class="rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star is-fade"></i>
								</div>
							</div>
						</li>
						<li>
							<div class="rl-thumb set-bg" data-setbg="img/thumb/4.jpg"></div>
							<div class="rl-info">
								<span>March 14, 2018</span>
								<h6>Onion Soup Gratinee</h6>
								<div class="rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star is-fade"></i>
								</div>
							</div>
						</li>
						<li>
							<div class="rl-thumb set-bg" data-setbg="img/thumb/4.jpg"></div>
							<div class="rl-info">
								<span>March 14, 2018</span>
								<h6>Feta Cheese Burgers</h6>
								<div class="rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star is-fade"></i>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div class="col-lg-4 col-md-6 ftw-warp">
					<div class="section-title">
						<h3>Most liked recipes</h3>
					</div>
					<ul class="sp-recipes-list">
						<li>
							<div class="rl-thumb set-bg" data-setbg="img/thumb/6.jpg"></div>
							<div class="rl-info">
								<span>March 14, 2018</span>
								<h6>Traditional Food</h6>
								<div class="rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star is-fade"></i>
								</div>
							</div>
						</li>
						<li>
							<div class="rl-thumb set-bg" data-setbg="img/thumb/7.jpg"></div>
							<div class="rl-info">
								<span>March 14, 2018</span>
								<h6>Baked Salmon</h6>
								<div class="rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star is-fade"></i>
								</div>
							</div>
						</li>
						<li>
							<div class="rl-thumb set-bg" data-setbg="img/thumb/8.jpg"></div>
							<div class="rl-info">
								<span>March 14, 2018</span>
								<h6>Deep Fried Fish</h6>
								<div class="rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star is-fade"></i>
								</div>
							</div>
						</li>
						<li>
							<div class="rl-thumb set-bg" data-setbg="img/thumb/9.jpg"></div>
							<div class="rl-info">
								<span>March 14, 2018</span>
								<h6>Raw Tomato Soup</h6>
								<div class="rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star is-fade"></i>
								</div>
							</div>
						</li>
						<li>
							<div class="rl-thumb set-bg" data-setbg="img/thumb/10.jpg"></div>
							<div class="rl-info">
								<span>March 14, 2018</span>
								<h6>Vegan Food</h6>
								<div class="rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star is-fade"></i>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<div class="col-lg-4">
					<div class="sp-blog-item">
						<div class="blog-thubm">
							<img src="img/blog/1.jpg" alt="">
							<div class="blog-date">
								<span>May 04, 2018</span>
							</div>
						</div>
						<div class="blog-text">
							<h5>Italian restaurant Review</h5>
							<span>By Maria Williams</span>
							<p>Donec quam felis, ultricies nec, pellente sque eu, pretium quis, sem. Nulla conseq uat massa quis enim. </p>
							<a href="#" class="comment">2 Comments</a>
							<a href="#" class="readmore"><i class="fa fa-angle-right"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Footer widgets section end -->


	<!-- Review section end -->
	<section class="review-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-8 offset-lg-0 offset-md-2">
					<div class="review-item">
						<div class="review-thumb set-bg" data-setbg="img/thumb/11.jpg">
							<div class="review-date">
								<span>May 04, 2018</span>
							</div>
						</div>
						<div class="review-text">
							<span>March 14, 2018</span>
							<h6>Feta Cheese Burgers</h6>
							<div class="rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star is-fade"></i>
							</div>
							<div class="author-meta">
								<div class="author-pic set-bg" data-setbg="img/author.jpg"></div>
								<p>By Janice Smith</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-8 offset-lg-0 offset-md-2">
					<div class="review-item">
						<div class="review-thumb set-bg" data-setbg="img/thumb/12.jpg">
							<div class="review-date">
								<span>May 04, 2018</span>
							</div>
						</div>
						<div class="review-text">
							<span>March 14, 2018</span>
							<h6>Mozarella Pasta</h6>
							<div class="rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star is-fade"></i>
							</div>
							<div class="author-meta">
								<div class="author-pic set-bg" data-setbg="img/author.jpg"></div>
								<p>By Janice Smith</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Review section end -->
	<?php include_once __DIR__ . "/../inc/footer.php" ?>

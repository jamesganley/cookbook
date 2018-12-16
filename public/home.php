
<?php include 'mainheader.php'; ?>
<?php include __DIR__ . "/../database.php"; ?>
<?php include_once 'includes/admin_functions.php' ?>
<?php include 'includes/recipe_functions.php'; ?>

<!-- Retrieve all posts from database  -->
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
								<li>Step by Step Tutorial</li>
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
	<!-- Hero section -->
	<section class="page-top-section set-bg" data-setbg="img/page-top-bg.jpg">
		<div class="container">
			<h2>Find a Recipe</h2>
		</div>
	</section>
	<!-- Hero section end -->

  <br>
  <br>

	<!-- Search section -->
	<div class="search-form-section">
		<div class="sf-warp">
			<div class="container" >
				<form method="post" action="home.php" style="background-color:#ff2a6b">
          <div class="md-form mt-0">
          <input class="form-control" name="search" type="text" placeholder="Search Recipes" aria-label="Search">
          </div>
					<button type="submit" name="button" class="btn btn-primary">Search</button>
				</form>
			</div>
		</div>
	</div>
	<!-- Search section end -->

<br>
<br>

<div> <?php
if(isset($_POST['search'])){
  $ingredient=$_POST['search'];
   echo getRecipe($api_keys, $ingredient, 'all ingredients', 6);
}
?> </div>

<br>
<br>



	<!-- Review section end -->
	<?php include_once __DIR__ . "/../inc/footer.php" ?>

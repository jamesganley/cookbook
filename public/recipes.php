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

<?php

require_once 'src/Unirest.php';

$api_keys = [
  "X-Mashape-Key" => "ovPM3cb30mmsh7abxqslX3XQ9bgZp101Drfjsn5Nc5rjIn4UyA",
  "X-Mashape-Host" => "spoonacular-recipe-food-nutrition-v1.p.mashape.com"
];

function getRecipe($api_keys, $query, $type, $number = 20) {
  $endpoint = "https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/";
  $endpoint .="search?number=${number}&offset=0&query=${query}&type=${type}";
  $response = Unirest\Request::get($endpoint, $api_keys);
  $meals = json_decode($response->raw_body)->results;

  /*function getInstructions($api_keys, $id) {
  $endpoint1 = "https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/"
  $endpoint1 = "$id/analyzedInstructions?";
  $response1 =  Unirest\Request::get($endpoint1, $api_keys);
  $instructions = json_decode($response1->raw_body)->steps;
}*/

  $html = "<div>";
  $baseUrl="https://spoonacular.com/recipeImages/";

  foreach ($meals as $meal) {
    $mealTitle = $meal->title;

    $mealid= $meal->id;
    $imgSrc = $baseUrl . $meal->image;
    $inguri="https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes/${mealid}/information";
    $response1 = Unirest\Request::get($inguri, $api_keys);
    $ings = json_decode($response1->raw_body)->instructions;
    // $inglines=$ings->

 $html .= "<li><img style='display: inlineBlock; width: 28%' src=${imgSrc}>${mealTitle}${ings}</li>";
  }

 $html .= "</div>";

  return $html;

  $option;
  $type=$option;

}
/*$response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/324694/analyzedInstructions?stepBreakdown=false",
  array(
    "X-Mashape-Key" => "ovPM3cb30mmsh7abxqslX3XQ9bgZp101Drfjsn5Nc5rjIn4UyA",
    "X-Mashape-Host" => "spoonacular-recipe-food-nutrition-v1.p.rapidapi.com"
  )
);
*/


if(isset($_POST['search'])){
  $ingredient=$_POST['search'];
}

if(isset($_POST['select'])){
  $option=$_POST['select'];
}

// echo getRecipe($api_keys, "chicken", "breakfast", 10);

?>
	<!-- Header section end -->
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>



	<!-- Hero section -->
	<section class="page-top-section set-bg" data-setbg="img/page-top-bg.jpg">
		<div class="container">
			<h2>Recipe</h2>
		</div>
	</section>
	<!-- Hero section end -->


	<!-- Search section -->
	<div class="search-form-section">
		<div class="sf-warp">
			<div class="container">
				<form class="big-search-form" method="post" action="recipes.php">
					<select name="select" method="post">
						<option>All Ingredients</option>
						<option>Breakfast</option>
						<option>Lunch</option>
						<option>Dinner</option>
					</select>
					<input type="text" name="search" placeholder="Search Receipies">
					<button class="bsf-btn">Search</button>
				</form>
			</div>
		</div>
	</div>
	<!-- Search section end -->

<p> <?php echo getRecipe($api_keys, $ingredient, $option, 10);?> </p>

	<!-- Recipes section end -->


	<!-- Gallery section -->
	<div class="gallery">
		<div class="gallery-slider owl-carousel">
			<div class="gs-item set-bg" data-setbg="img/instagram/1.jpg"></div>
			<div class="gs-item set-bg" data-setbg="img/instagram/2.jpg"></div>
			<div class="gs-item set-bg" data-setbg="img/instagram/3.jpg"></div>
			<div class="gs-item set-bg" data-setbg="img/instagram/4.jpg"></div>
			<div class="gs-item set-bg" data-setbg="img/instagram/5.jpg"></div>
			<div class="gs-item set-bg" data-setbg="img/instagram/6.jpg"></div>
		</div>
	</div>
	<!-- Gallery section end -->


	<!-- Footer section  -->
	<footer class="footer-section set-bg" data-setbg="img/footer-bg.jpg">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<div class="footer-logo">
						<img src="img/logo.png" alt="">
					</div>
					<div class="footer-social">
						<a href="#"><i class="fa fa-pinterest"></i></a>
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-dribbble"></i></a>
						<a href="#"><i class="fa fa-behance"></i></a>
						<a href="#"><i class="fa fa-linkedin"></i></a>
					</div>
				</div>
				<div class="col-lg-6 text-lg-right">
					<ul class="footer-menu">
						<li><a href="#">Home</a></li>
						<li><a href="#">Features</a></li>
						<li><a href="#">Receipies</a></li>
						<li><a href="#">Reviews</a></li>
						<li><a href="#">Contact</a></li>
					</ul>
					<p class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer section end -->



	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>

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
<?php include 'includes/recipe_functions.php'; ?>



  <link rel="stylesheet" type="text/css" href="style.css">
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>



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
				<form method="post" action="recipes.php" style="background-color:#ff2a6b">
					<select  name="select_catalog" id="select_catalog">
            <option>All Ingredients</option>
            <option>Breakfast</option>
						<option>Lunch</option>
						<option>Dinner</option>
					</select>
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
  $option=$_POST['select_catalog'];
   echo getRecipe($api_keys, $ingredient, $option, 6);
}
?> </div>

<br>
<br>

	<!-- Recipes section end -->
	<?php include_once __DIR__ . "/../inc/footer.php" ?>

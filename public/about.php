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

<?php include_once __DIR__ . '/../inc/header.php';?>
<?php include '../database.php';?>
<?php include_once 'uploadfunction.php' ?>
<?php
	if (isset($_GET['edit'])) {
    global $db;
		$id = $_GET['edit'];
		$update = true;

		$record = mysqli_query($db, "SELECT * FROM crud WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$item = $n['item'];
			$quantity = $n['quantity'];
      $expiry = $n['expiry'];
		}
	}
  if (isset($_GET['del'])) {
  $id = $_GET['del'];
  mysqli_query($db, "DELETE FROM crud WHERE id=$id");
  }
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
			<h2>What's in my Fridge</h2>
		</div>
	</section>
	<!-- Hero section end -->
  <?php $user_id = $_SESSION['user_id']; $results = mysqli_query($db, "SELECT * FROM crud WHERE user_id=${user_id}"); ?>

    <table>
      <thead>
        <tr>
          <th>Item</th>
          <th>Quantity</th>
          <th>Expire Date</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>

      <?php while ($row = mysqli_fetch_array($results)) { ?>
        <tr>
          <td><?php echo $row['item']; ?></td>
          <td><?php echo $row['quantity']; ?></td>
          <td><?php echo $row['expiry']; ?></td>

          <td>
            <a href="about.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
          </td>
          <td>
            <a href="about.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
          </td>
        </tr>
      <?php } ?>
    </table>

	<!-- Search section -->
	<!-- <div class="search-form-section">
		<div class="sf-warp">
			<div class="container">
				<form class="big-search-form">
					<! <select>
						<option>All Recipes Categories</option>
						<option>Pizza</option>
						<option>Salads</option>
						<option>Desserts</option>
						<option>Side Dishes</option>
					</select>
					<select>
						<option>All Ingredients</option>
						<option>Breakfast</option>
						<option>Lunch</option>
						<option>Dinner</option>
					</select> -->
				<!--	<input type="text" placeholder="Search Receipies">
					<button class="bsf-btn">Search</button>
				</form>
			</div>
		</div>
	</div> -->

	<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>

	<form method="post" >
<input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="input-group">
			<label>Item</label>
			<input type="text" name="item" value="<?php echo $item; ?>">
		</div>
		<div class="input-group">
			<label>Quantity</label>
			<input type="text" name="quantity" value="<?php echo $quantity; ?>">
		</div>
		<div class="input-group">
			<label>EXpiry Date</label>
			<input type="text" name="expiry" value="<?php echo $expiry; ?>">
		</div>
		<div class="input-group">
      <?php if ($update == true): ?>
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
<?php else: ?>
	<button class="btn" type="submit" name="save" >Save</button>
<?php endif ?>
		</div>
	</form>
	<!-- Search section end -->





	<!-- Facts section -->
	<section class="facts-section">
		<div class="facts-warp">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-sm-6 fact-item">
						<div class="fact-icon">
							<img src="img/icon/1.png" alt="">
						</div>
						<h2>1287</h2>
						<p>Amazing receipies</p>
					</div>
					<div class="col-lg-3 col-sm-6 fact-item">
						<div class="fact-icon">
							<img src="img/icon/2.png" alt="">
						</div>
						<h2>25</h2>
						<p>Wine pairings</p>
					</div>
					<div class="col-lg-3 col-sm-6 fact-item">
						<div class="fact-icon">
							<img src="img/icon/3.png" alt="">
						</div>
						<h2>471</h2>
						<p>Meat receipies</p>
					</div>
					<div class="col-lg-3 col-sm-6 fact-item">
						<div class="fact-icon">
							<img src="img/icon/4.png" alt="">
						</div>
						<h2>326</h2>
						<p>Desert receipies</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Facts section end -->


  <?php include_once __DIR__ . "/../inc/footer.php" ?>

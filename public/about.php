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
		if (!$record == NULL ) {
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

  <div class="container">
    <div class="row">
      <div class="col-4">
        <form class="fridgeForm" method="post">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <div class="form-group">
            <label for="exampleInputEmail1">Item Name</label>
            <input
            name="item"
            type="text"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            placeholder="Enter email"
            value="<?php echo $item; ?>"
            >
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Quantity</label>
            <input
              name="quantity"
              type="number"
              class="form-control"
              id="exampleInputEmail1"
              aria-describedby="emailHelp"
              placeholder="Enter email"
              value="<?php echo $quantity; ?>"
              >
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Expiry Date</label>
            <input
              name="expiry"
              type="date"
              class="form-control"
              id="exampleInputEmail1"
              aria-describedby="emailHelp"
              placeholder="Enter email"
              value="<?php echo $expiry; ?>"
            >
          </div>

          <div class="form-group fridge">
            <?php if ($update == true): ?>
              <button type="submit" class="btn btn-primary btn-block" name="update">Update</button>
            <?php else: ?>
              <button class="btn btn-primary btn-block" type="submit" name="save" >Add</button>
            <?php endif ?>
          </div>
        </form>
      </div>

      <div class="col-8">
        <table class="fridgeTable table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th>Item</th>
              <th>Quantity</th>
              <th>Expire Date</th>
              <th>Action</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
          <?php
          $count = 0;
          while ($row = mysqli_fetch_array($results)) {
            $count++;
          ?>
            <tr>
              <th scope="row"><?php echo $count ?></th>
              <td><?php echo $row['item']; ?></td>
              <td><?php echo $row['quantity']; ?></td>
              <td><?php echo $row['expiry']; ?></td>
              <td>
                <a href="about.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
              </td>
              <td>
                <a href="about.php?del=<?php echo $row['id']; ?>" class="del_btn">Remove</a>
              </td>
            <?php } ?>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

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

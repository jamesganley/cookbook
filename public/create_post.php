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
<?php include_once 'includes/post_functions.php' ?>

<!-- Get all topics -->
<?php $topics = getAllTopics();	?>


		<!-- Middle form - to create and edit  -->
		<div class="action create-post-div">
			<center><h1 class="page-title">Create/Edit Post</h1></center>
			<form method="post" enctype="multipart/form-data" action="<?php echo 'create_post.php'; ?>" >
				<!-- validation errors for the form -->
  			<?php include 'errors.php'?>

				<!-- if editing post, the id is required to identify that post -->
				<?php if ($isEditingPost === true): ?>
					<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
				<?php endif ?>

				<input type="text" name="title" value="<?php echo $title; ?>" placeholder="Title">
				<label style="float: left; margin: 5px auto 5px;">Featured image</label>
				<input type="file" name="featured_image" >
				<textarea name="body" id="body" cols="30" rows="10"><?php echo $body; ?></textarea>
				<select name="topic_id">
					<option value="" selected disabled>Choose topic</option>
					<?php foreach ($topics as $topic): ?>
						<option value="<?php echo $topic['id']; ?>">
							<?php echo $topic['name']; ?>
						</option>
					<?php endforeach ?>
				</select>

					<!-- display checkbox according to whether post has been published or not -->
					<?php if ($published == true): ?>
						<label for="publish">
							Publish
							<input type="checkbox" value="1" name="publish" checked="checked">&nbsp;
						</label>
					<?php else: ?>
						<label for="publish">
							Publish
							<input type="checkbox" value="1" name="publish">&nbsp;
						</label>
					<?php endif ?>

				<!-- if editing post, display the update button instead of create button -->
				<?php if ($isEditingPost === true): ?>
					<button type="submit" class="btn" name="update_post">UPDATE</button>
				<?php else: ?>
					<button type="submit" class="btn" name="create_post">Save Post</button>
				<?php endif ?>

			</form>
		</div>


<script>
	CKEDITOR.replace('body');
</script>
<!-- Review section end -->
<footer class="footer-section set-bg" data-setbg="img/footer-bg.jpg">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="footer-logo">
          <img src="img/logo.jpg" alt="">
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

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</body>
</html>

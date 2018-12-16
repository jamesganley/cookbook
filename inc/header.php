<!DOCTYPE php>
<php lang="en">
<head>
	<title>CookBook</title>
	<meta charset="UTF-8">
	<meta name="description" content="Food Blog Web Template">
	<meta name="keywords" content="food, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,400i,500,500i,600,600i,700" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="/css/owl.carousel.css"/>
	<link rel="stylesheet" href="/css/animate.css"/>
	<link rel="stylesheet" href="/css/style.css"/>
	<link rel="stylesheet" href="/css/cookbookstyles.css"/>
	<link rel="stylesheet" href="/css/fridge.css"/>

	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>

	<!-- Page Preloder -->
	<!-- <div id="preloder">
		<div class="loader"></div>
	</div> -->

	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="header-social"><?php  if (isset($_SESSION['username'])) : ?>
						<p  style="color: white;">Welcome <strong><?php echo $_SESSION['username']; ?></strong></p><?php endif ?>
				</div>
				<div class="user-panel">
				</div>
			</div>
		</div>
		<div class="header-bottom">
			<div class="container">
				<a href="index.php" class="site-logo">
					<img src="img/Logo.jpg" alt="">
				</a>
				<div class="nav-switch">
					<i class="fa fa-bars"></i>
				</div>
				<ul class="main-menu">
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">Whats in my Fridge</a></li>
					<li><a href="recipes.php">Find a Recipe</a></li>
					<li><a href="dashboard.php">Posts</a></li>
					<li><a href="create_post.php">Create Post</a></li>
					<li><a href="posts.php">Manage Post</a></li>
					<?php  if (isset($_SESSION['username'])) : ?>
					<li><a href="index.php?logout='1'" style="color: red;">Logout</a></li><?php endif ?>
				</ul>
			</div>
		</div>

	</header>

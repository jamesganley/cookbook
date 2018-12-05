
<?php include_once __DIR__ . '/../inc/header.php'; ?>
<?php include __DIR__ . "/../database.php"; ?>
<?php include('includes/admin_functions.php'); ?>
<?php
	if (isset($_GET['post-slug'])) {
		$post = getPost($_GET['post-slug']);
	}
?>

<body>
	<div class="container">
					<div class="sp-blog-item">
						<?php if ($post['published'] == false): ?>
							<h2 class="post-title">Sorry... This post has not been published</h2>
						<?php else: ?>
						<div class="blog-thubm">
							<img src="<?php echo 'static/images/' . $post['image']; ?>" alt="">
						</div>
						<div class="blog-text">
							<span><?php echo $post['title']; ?></span>
							<p><?php echo html_entity_decode($post['body']); ?></p>
						</div>
						<?php endif ?>
					</div>
</div>

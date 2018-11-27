<!DOCTYPE html>
<?php  include('php_code.php'); ?>

<?php
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($conn, "SELECT * FROM crud WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$name = $n['name'];
			$address = $n['address'];
		}
	}
?>

<html>
<head>
	<title>CRUD: CReate, Update, Delete PHP MySQL</title>
  <link rel="stylesheet" type="text/css" href="css/crud.css">
</head>
<body>

  <?php if (isset($_SESSION['message'])): ?>
  	<div class="msg">
  		<?php
  			echo $_SESSION['message'];
  			unset($_SESSION['message']);
  		?>
  	</div>
  <?php endif ?>
  <?php $results = mysqli_query($conn, "SELECT * FROM crud"); ?>

    <table>
    	<thead>
    		<tr>
    			<th>Name</th>
    			<th>Address</th>
    			<th colspan="2">Action</th>
    		</tr>
    	</thead>

    	<?php while ($row = mysqli_fetch_array($results)) { ?>
    		<tr>
    			<td><?php echo $row['name']; ?></td>
    			<td><?php echo $row['address']; ?></td>
    			<td>
    				<a href="upload.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
    			</td>
    			<td>
    				<a href="php_code.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
    			</td>
    		</tr>
    	<?php } ?>
    </table>


	<form method="post" action="php_code.php" >
		<div class="input-group">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
			<label>Name</label>
			<input type="text" name="name" value="<?php echo $name; ?>">
		</div>
		<div class="input-group">
			<label>Address</label>
			<input type="text" name="address" value="<?php echo $address; ?>">
		</div>
		<div class="input-group">
      <?php if ($update == true): ?>
	<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
<?php else: ?>
	<button class="btn" type="submit" name="save" >Save</button>
<?php endif ?>
		</div>
	</form>
</body>
</html>

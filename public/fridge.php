<?php

include_once '../database.php';
include_once '../inc/header.php';

$userIsLoggedIn = false;

if (isset($_SESSION["user_id"])) {
	$userIsLoggedIn = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if ($userIsLoggedIn) {

		$fridge = $db1->query("SELECT * FROM fridge");
		$action = $_POST['action'];
		$userId = $_SESSION['user_id'];
		$foodId = $_POST['id'];

		if ($action == "edit") {
			//$db->query("");

		} else if ($action == "delete") {
			//$db->query("");
		}

		$db->query("INSERT INTO fridge (item, user_id)
		VALUES('${food}', '${user_id}')");

	} else {
		header("location: /login.php");
	}

}

?>

	<form method="post" >
		<label for="food">Add Food</label>
		<input type="text" name="food" value="">
		<button type="submit" name="button">Submit</button>
	</form>

	<?php
  if (count($fridge) > 0) {
  	?>

			<table>
				<tr>
					<th>Item</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
				<?php foreach ($fridge as $food): ?>
					<form class="" method="post">
						<input type="hidden" name="id" value="<?php echo $food['id']; ?>">
						<tr>
						<td><?php echo $food["item"];  ?></td>
							<td><button name="action" type="submit" value="edit">Edit</button></td>
							<td><button name="action"  type="submit" value="delete">delete</button></td>
						</tr>
					</form>
				<?php endforeach; ?>
			</table>

  <?php } else {
  	echo "There is currently no food in your fridge";
  }?>


</html>

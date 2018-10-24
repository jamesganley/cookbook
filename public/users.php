<!--
Example of how to query the database and ouput the result of the query

-->
<?php

// include __DIR__ . '/../inc/header.php';
require_once __DIR__ .  '/../database.php';

$users = $db->query("SELECT * FROM users")->fetchAll();

?>

<ul>
  <?php

  for ($i=0; $i < count($users) ; $i++) {
    // code...
    $user = $users[$i]; ?>

    <li><?php echo $user['username']; ?></li>

  <?php } ?>

</ul>

<?php
  // include './inc/footer.php';
?>

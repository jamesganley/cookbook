<!--
Example of how to query the database and ouput the result of the query

-->
<?php

require_once '../database.php';

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

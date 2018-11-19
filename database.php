<?php
// Code from
// https://phpdelusions.net/pdo

$host = 'db4free.net';
$dbname   = 'cookbook';
$user = 'b1c0ec52c43297';
$pass = 'c7b13df7';
$charset = 'utf8mb4';

$db = mysqli_connect("mysql://b1c0ec52c43297:c7b13df7@eu-cdbr-west-02.cleardb.net/heroku_747dca5e35081c0?reconnect=true");

	if (!$db) {
		die("Error connecting to database: " . mysqli_connect_error());
	}

// $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
//
// $options = [
//     PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
//     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//     PDO::ATTR_EMULATE_PREPARES   => false,
// ];
// try {
//      $db2 = new PDO($dsn, $user, $pass, $options);
// } catch (\PDOException $e) {
//      throw new \PDOException($e->getMessage(), (int)$e->getCode());
// }


?>

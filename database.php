<?php
// Code from
// https://phpdelusions.net/pdo

$host = 'db4free.net';
$dbname   = 'cookbook';
$user = 'cookbook';
$pass = 'cookbook123';
$charset = 'utf8mb4';

$db = mysqli_connect($host, $user, $pass, $dbname);

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

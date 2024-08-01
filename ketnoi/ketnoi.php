<?php
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$db_host = $_ENV['DB_HOST'];
$db_port = $_ENV['DB_PORT'];
$db_database = $_ENV['DB_DATABASE'];
$db_username = $_ENV['DB_USER'];
$db_password = $_ENV['DB_PASSWORD'];

$conn = new mysqli($db_host, $db_username, $db_password, $db_database, $db_port);

if ($conn) {
	$setLang = mysqli_query($conn, "SET NAMES 'utf8'");
} else {
	die("ket noi that bai" . mysqli_connect_errno());
}

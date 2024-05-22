<?php
	$dbHost = 'localhost';
	$dbUser = 'root';
	$dbPassword = '';
	$dbName="webdongho";

	$conn = mysqli_connect($dbHost,$dbUser,$dbPassword,$dbName);

	if($conn)
	{
		$setLang=mysqli_query($conn, "SET NAMES 'utf8'");
	}
	else{
		die("ket noi that bai".mysqli_connect_errno());
	}
  
?>

<?php
	$dbHost = 'mysql.railway.internal';
	$dbUser = 'root';
	$dbPassword = 'iGyDcTZVYGaufsyFwAlyxyObqYzRvxoM';
	$dbName="railway";
	$dbPort = 3306;

	$conn = mysqli_connect($dbHost,$dbUser,$dbPassword,$dbName,$dbPort);

	if($conn)
	{
		$setLang=mysqli_query($conn, "SET NAMES 'utf8'");
	}
	else{
		die("ket noi that bai".mysqli_connect_errno());
	}
  
?>

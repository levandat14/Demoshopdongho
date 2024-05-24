<?php
	$dbHost = 'roundhouse.proxy.rlwy.net';
	$dbUser = 'root';
	$dbPassword = 'BjDQDkrAbzTfSyfYLhqNeyljauKFdVyn';
	$dbName="railway";

	$conn = mysqli_connect($dbHost,$dbUser,$dbPassword,$dbName);

	if($conn)
	{
		$setLang=mysqli_query($conn, "SET NAMES 'utf8'");
	}
	else{
		die("ket noi that bai".mysqli_connect_errno());
	}
  
?>

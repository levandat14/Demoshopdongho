<?php
	session_start();
	$MaDongHo = $_GET['MaDongHo'];
	if($MaDongHo==0){
		unset($_SESSION['giohang']);
	}else{
		unset($_SESSION['giohang'][$MaDongHo]);
		//Nếu không còn sản phẩm trong giỏ hàng -> Xỏa giỏ hàng
	if(count($_SESSION['giohang'])==0){
		unset($_SESSION['giohang']);
	}
	}
	
	header('location: ../index.php?page_layout=giohang');
?>
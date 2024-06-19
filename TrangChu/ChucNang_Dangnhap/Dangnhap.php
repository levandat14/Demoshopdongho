<?php
  require_once("../ketnoi/ketnoi.php");

  $error=NULL;

if(isset($_POST['submit'])&&($_POST['submit'])){
	if($_POST['tk']==""){
		$error = "Vui lòng nhập tài khoản và mật khẩu";
	}else{
		$tk = htmlspecialchars($_POST['tk']);
	}

	if($_POST['mk']==""){
		$error = "Vui lòng nhập tài khoản và mật khẩu";
	}else{
		$mk = htmlspecialchars($_POST['mk']);
		$mk_MaHoa=md5($mk);
	}

	if (isset($tk) && isset($mk)) {
		$sql = "SELECT * FROM khachhang WHERE TaiKhoan='$tk' AND MatKhau='$mk_MaHoa'  ";
		$query = mysqli_query($conn, $sql);
		$rows = mysqli_num_rows($query);

		if($rows > 0) {
			$_SESSION['tkc']=$tk;
			$_SESSION['mkc']=$mk_MaHoa;
			echo '<script>alert("Qúy Khách Đã Đăng Nhập Thành Công!");
			window.location.href="../index.php";
			</script>';
		} 
		// if(isset($_POST['check'])&&($_POST['check'])){
			
		// 	setcookie("tk", "$tk", time() + 3600, "/"); 
		// 	setcookie("mk","$mk_MaHoa", time()+ 3600, "/");
		// }
		else{
	
			echo '<script>alert("Tài Khoản Hoặc Mật Khẩu Không Đúng!");</script>';
	}
	
}

}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf8" />
	<title>Đăng nhập hệ thống</title>
	<link rel="stylesheet" type="text/css" href="css/dangnhap.css" />
</head>

<body>
	<?php
	if (!isset($_SESSION['tkc'])) {


	?>
		<form method="post">
			<div id="form-login">
				<h2>Đăng Nhập Website Để Mua </h2>
				<span style="color:red;"><?php echo $error;?></span>
				<ul>
					<li><label>tài khoản</label><input class="form-control" type="text" name="tk" value="<?php echo isset($_POST['tk'])? $_POST['tk']: "";  ?>" /></li> 
					<li><label>mật khẩu</label><input class="form-control"  type="password" name="mk" /></li>
					<li><label>ghi nhớ</label><input type="checkbox" name="check" /></li>
					<li><input class="btn btn-success" type="submit" name="submit" value="Đăng nhập" /> <button class="btn btn-info"><a target="_blank" href="ChucNang_DangNhap/Dangki.php">Đăng Kí</a></button></li>
				</ul>
			</div>
		</form>
	<?php
	} 

	?>
</body>

</html>
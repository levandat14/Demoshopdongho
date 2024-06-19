<?php

session_start();
require_once('../ketnoi/ketnoi.php');

?>
<?php
		$error=NULL;
		if(isset($_POST['submit'])){
			$tk = $_POST['tk'];
			$mk = $_POST['mk'];
			$sql = "SELECT MatKhau FROM admin WHERE TenDangNhap='$tk'";
			$query = mysqli_query($conn, $sql);
		
			if ($query && mysqli_num_rows($query) > 0) {
				$row = mysqli_fetch_assoc($query);
				$hashed_password_from_db = $row['MatKhau']; // Lấy mật khẩu đã băm từ cơ sở dữ liệu
				if (password_verify($mk, $hashed_password_from_db)) { // so sánh mật khẩu
					$_SESSION['tk'] = $tk;
					header('location: ../quantri.php');
				} else {
					echo '<script>alert("Mật Khẩu Không Đúng!");</script>';
				}
			} else {
				echo '<script>alert("Tên Đăng Nhập Không Tồn Tại!");</script>';
			}
		}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf8" />
	<title>Mobile Shop - Đăng nhập hệ thống</title>
	<link rel="stylesheet" type="text/css" href="../css/dangnhap.css" />
</head>

<body>
	<?php
	if (!isset($_SESSION['tk'])) {


	?>
		<form method="post">
			<div id="form-login">
				<h2>đăng nhập hệ thống quản trị</h2>
				<span style="color:red;"><?php echo $error;?></span>
				<ul>
					<li><label>tài khoản</label><input  type="text" name="tk" value="<?php echo isset($_POST['tk'])? $_POST['tk']: "";  ?>" /></li> 
					<li><label>mật khẩu</label><input  type="password" name="mk" /></li>
					<li><label>ghi nhớ</label><input type="checkbox" name="check" checked="checked" /></li>
					<li><input  type="submit" name="submit" value="Đăng nhập" /> <input type="reset" name="resset" value="Làm mới" /></li>
				</ul>
			</div>
		</form>
	<?php
	} else {
		header('location: ../quantri.php');
	}

	?>
</body>

</html>
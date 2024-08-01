<link rel="stylesheet" type="text/css" href="css/dangnhap.css" />
<?php
require_once __DIR__ . '/../../ketnoi/ketnoi.php';
if(isset($_SESSION['tkc'])){
    $tk=$_SESSION['tkc'];
    $sql="SELECT * FROM khachhang WHERE TaiKhoan='$tk'";
    $query=mysqli_query($conn, $sql);
    $row=mysqli_fetch_array($query);

    //xử lý
    if(isset($_POST['btnsubmit'])){
        $ho_ten=$_POST['txthoten'];
        $dia_chi=$_POST['txtdiachi'];
        $sdt=$_POST['txtsdt'];
        if(isset($ho_ten) && isset($dia_chi) && isset($sdt)){
            $sql="UPDATE khachhang SET TenKH='$ho_ten', DiaChi='$dia_chi', SDT='$sdt' where TaiKhoan='$tk' ";
            $query=mysqli_query($conn,$sql);
            echo '<script>'; 
            echo 'window.location.href="index.php?page_layout=thongtin";';
            echo '</script>';         
        }

    }
?>


<form method="post">
    <div class="prd-block">
        <h2>Xin chào: <?php echo $row['TenKH']; ?></h2>
    </div>
    <div id="form-login">
				<h2>Thông tin của bạn</h2>
				<ul>
					<li><label>Họ Và Tên:</label><input required type="text" name="txthoten" value="<?php echo $row['TenKH'] ?>" /></li> 
					<li><label>Tài Khoản:</label><input readonly  type="text" name="txttaikhoan"value="<?php echo $row['TaiKhoan'] ?>" /></li>
                    <li><label>Email: </label><input readonly type="text" name="txtemail" value="<?php echo $row['Email'] ?>" /></li> 
                    <li><label>Địa Chỉ:</label><input required type="text" name="txtdiachi" value="<?php echo $row['DiaChi'] ?>" /></li> 
                    <li><label>SĐT</label><input required type="tel" pattern="[0][0-9]{9}" name="txtsdt" value="<?php echo $row['SDT'] ?>" /></li> 
					<li><input class="btn btn-success" type="submit" name="btnsubmit" value="Cập Nhập" /> <button class="btn"><a href="index.php">Quay Lại</a></button>
                    <button class="btn btn-success"><a href="index.php?page_layout=doimatkhaukh" style="color: white;">Đổi Mật Khẩu</a></button></li>
                    
				</ul>
                
                <p>
                    <b style="color: red;">Lưu ý:</b>
                    Qúy khách có thể đổi thông tin <b>Họ Và Tên, Địa Chỉ và SĐT</b> của mình ngay trên form.
                </p> 
               
               
	</div>
</form>
<?php
} else {
    echo '<script>alert("Qúy khách vui lòng đăng nhập để sử dụng chức năng này",  window.location.href = "index.php");</script>';


}
?>
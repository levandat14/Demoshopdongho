<link rel="stylesheet" type="text/css" href="css/chitietdonhang.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<?php

require_once('../ketnoi/ketnoi.php');

if(isset($_SESSION['tk'])){
$madh = $_GET['madh'];
$sql = "SELECT dh.MaDonHang, dh.MaDongHo, dh.NgayDat, dh.NgayGiao, 
                dh.SoLuong, dh.TongTien, dh.TinhTrangThanhToan, 
                dh.TinhTrangDonHang, sp.TenDongHo, kh.TaiKhoan, kh.TenKH,
                kh.Email, kh.DiaChi, kh.SDT, dh.MaKH
         FROM  donhang dh
         INNER JOIN khachhang kh ON kh.MaKH=dh.MaKH
         INNER JOIN sanpham sp ON sp.MaDongHo=dh.MaDongHo
         WHERE dh.MaDonHang='$madh'
         ";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);

//Xử Lý phần sửa thông tin khách hàng
if(isset($_POST['btnsuathongtinkh'])){
    $ho_ten=$_POST['txttenkh'];
    $email=$_POST['txtemail'];
    $dia_chi=$_POST['txtdiachi'];
    $sdt=$_POST['txtsdt'];
    $MaKH=$row['MaKH'];

    if(isset($ho_ten) && isset($email) && isset($dia_chi) && isset($sdt)){
        $sql="UPDATE khachhang SET TenKH='$ho_ten', Email='$email', DiaChi='$dia_chi', SDT='$sdt' where MaKH='$MaKH' ";
        $query=mysqli_query($conn,$sql);
        $chitietdonhang_url = "quantri.php?page_layout=chitietdonhang&madh=" . ($row['MaDonHang']);
    
        echo '<script>'; 
            echo 'window.location.href="'. $chitietdonhang_url.'";';
            echo '</script>';      
    }

}
?>

<form method="post">
    <div class="prd-block">
        <h2>Thông Tin Đơn Hàng: <?php echo $row['MaDonHang']; ?></h2>
    </div>
    <div id="form-login">
    <h3>Thông tin đơn hàng</h3>
				<ul>
					<li><label>Mã Đơn Hàng:</label><input disabled required type="text" value="<?php echo $row['MaDonHang'] ?>" /></li> 
                    <li><label>Tên Sản Phẩm:</label><input disabled required type="text" value="<?php echo $row['TenDongHo'] ?>" /></li> 
                    <li><label>Ngày Đặt:</label><input disabled required type="text" value="<?php echo $row['NgayDat'] ?>" /></li> 
                    <li><label>Ngày Giao:</label><input disabled required type="text" value="<?php echo $row['NgayGiao'] ?>" /></li> 
                    <li><label>Số Lượng:</label><input disabled required type="text" value="<?php echo $row['SoLuong'] ?>" /></li> 
                    <li><label>Tổng Tiền:</label><input disabled required type="text" value="<?php echo number_format( $row['TongTien']) ?>" /></li> 
                    <li><label>Tình Trạng Thanh Toán:</label><input disabled required type="text" value="<?php echo $row['TinhTrangThanhToan'] ?>" /></li> 

                    <li><label>Tình Trạng Đơn Hàng:</label><input disabled required type="text" value="<?php echo $row['TinhTrangDonHang'] ?>" /></li> 

                    <input class="btn btn-success" type="button" value="Sửa Đơn Hàng" onclick="window.location.href = 'quantri.php?page_layout=suadonhang&madh=<?php echo $row['MaDonHang'] ?>'" />
                    <button class="btn"><a href="quantri.php?page_layout=danhsachdonhang">Quay Lại</a></button>
				</ul>   
	</div>
    <div id="form-login">
    <h3>Thông tin khách hàng</h3>
				<ul>
					<li><label>Tên Khách Hàng:</label><input  required type="text" name="txttenkh" value="<?php echo $row['TenKH'] ?>" /></li> 
                    <li><label>Tài Khoản Đăng Nhập:</label><input disabled required type="text" name="txttaikhoan" value="<?php echo $row['TaiKhoan'] ?>" /></li> 
                    <li><label>Email:</label><input  required type="text" name="txtemail" value="<?php echo $row['Email'] ?>" /></li> 
                    <li><label>Địa Chỉ:</label><input  required type="text" name="txtdiachi" value="<?php echo $row['DiaChi'] ?>" /></li> 
                    <li><label>SĐT</label><input required type="tel" pattern="[0][0-9]{9}" name="txtsdt" value="<?php echo $row['SDT'] ?>" /></li> 
                    
                    <input type="hidden" name="btnsuathongtinkh" value="true">
                    <input class="btn btn-success" type="submit" value="Sửa Thông Tin">
                    <button class="btn"><a href="quantri.php?page_layout=danhsachdonhang">Quay Lại</a></button>
                    <p>
                    <b style="color: red;">Lưu ý:</b>
                    Thay đổi thông tin <b>Tên khách hàng, Email, Địa Chỉ và SĐT</b> của khách hàng ở trên form.
                </p> 
				</ul>   
	</div>
</form>
<?php
} else {
		header('location: ../quantri.php');
	}
?>
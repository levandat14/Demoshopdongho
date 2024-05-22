<?php
require_once "../ketnoi/ketnoi.php";
$tkc=$_SESSION['tkc'];
$sql=("SELECT dh.MaDonHang, dh.MaDongHo 
FROM donhang dh
INNER JOIN khachhang kh ON kh.MaKH = dh.MaKH
WHERE kh.TaiKhoan = '$tkc'
");
$query = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($query);
echo $num_rows; 
?>
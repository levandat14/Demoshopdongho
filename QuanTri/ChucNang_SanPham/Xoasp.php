<?php
if($_SESSION['tk']){
require_once "../ketnoi/ketnoi.php";
$masp=$_GET['masp'];
$sql="DELETE FROM sanpham WHERE MaDongHo='$masp' ";
$query=mysqli_query($conn, $sql);
header('location: quantri.php?page_layout=danhsachsp');
}else {
    header('location: ../quantri.php');
}
?>
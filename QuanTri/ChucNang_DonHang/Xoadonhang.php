<?php
require_once("../ketnoi/ketnoi.php");
if (isset($_SESSION['tk'])) {
    if (isset($_GET['madh'])) {
        $madh = $_GET['madh'];
        mysqli_begin_transaction($conn);
        try {
            // Cập nhật tồn kho
            $sql_edit = "UPDATE sanpham s
                 JOIN (SELECT MaDongHo, SoLuong FROM donhang WHERE MaDonHang='$madh') d
                 ON s.MaDongHo = d.MaDongHo
                 SET s.SoLuong = s.SoLuong + d.SoLuong";
            if (!mysqli_query($conn, $sql_edit)) {
                throw new Exception("Lỗi khi cập nhật số lượng tồn: " . mysqli_error($conn));
            }
            // Xóa đơn hàng
            $sql = "DELETE FROM donhang WHERE MaDonHang='$madh'";
            if (!mysqli_query($conn, $sql)) {
                throw new Exception("Lỗi khi xóa đơn hàng: " . mysqli_error($conn));
            }
            mysqli_commit($conn);
            header('Location: quantri.php?page_layout=danhsachdonhang');
        } catch (Exception $e) {
            mysqli_rollback($conn);
            echo $e->getMessage();
        }
    }
} else {
    header('location: ../quantri.php');
}

<?php
// Kiểm tra và bật hiển thị lỗi (chỉ trong quá trình phát triển, tắt khi đưa vào sản xuất)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Kiểm tra không có đầu ra trước lệnh header
if (!headers_sent()) {
    header("Location: TrangChu/ChuNang_DangNhap/Dangnhap.php");
    exit;
} else {
    echo "Cannot redirect, headers already sent!";
}
?>

<link rel="stylesheet" type="text/css" href="css/themsp.css" />
<?php
ob_start();
if(isset($_POST['btnsubmit'])){
    // Lấy dữ liệu từ biểu mẫu
    $tk=$_POST['txttaikhoan'];
    $password=$_POST['txtmatkhau'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Kiểm tra xem tài khoản đã tồn tại chưa
    $check_sql = "SELECT * FROM admin WHERE TenDangNhap = '$tk'";
    $check_query = mysqli_query($conn, $check_sql);
    
    // Nếu không có bản ghi nào được trả về, có nghĩa là tài khoản chưa tồn tại
    if(mysqli_num_rows($check_query) == 0){
        // Thêm tài khoản vào cơ sở dữ liệu
        $sql = "INSERT INTO admin (TenDangNhap, MatKhau) VALUES ('$tk', '$hashed_password')";
        $query=mysqli_query($conn, $sql);
        echo '<script type="text/javascript">';
        echo 'window.location.href="quantri.php?page_layout=dangkitkadmin";';
        echo '</script>';
    } else {
        // Nếu tài khoản đã tồn tại, hiển thị thông báo cho người dùng
        echo '<script>alert("Tài khoản đã tồn tại.");</script>';
    }
}
ob_end_flush();
?>
<h2>Thêm Tai Khoản Quản Lý</h2>
<div id="main">
    <form method="post">
        <input required placeholder="Nhập Tài Khoản" type="text" name="txttaikhoan">
        <input required placeholder="Nhập Mật Khẩu" type="password" name="txtmatkhau">
        <input type="submit" name="btnsubmit" value="Thêm">

</div>
</from>
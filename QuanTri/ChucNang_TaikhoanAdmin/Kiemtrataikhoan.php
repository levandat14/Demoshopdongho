<?php   
    require_once("../ketnoi/ketnoi.php");
    if(isset($_SESSION['tk'])) {
    $tk = $_SESSION['tk'];
    $sql = "SELECT * FROM admin WHERE TenDangNhap = '$tk'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    }
?>
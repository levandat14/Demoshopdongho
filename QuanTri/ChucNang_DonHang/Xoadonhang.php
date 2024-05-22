<?php
    require_once("../ketnoi/ketnoi.php");
    if(isset($_SESSION['tk'])){
    if (isset($_GET['madh'])) {
        $madh = $_GET['madh'];
            $sql = "DELETE FROM donhang where MaDonHang='$madh'";
            $query = mysqli_query($conn, $sql);
            header('Location: quantri.php?page_layout=danhsachdonhang');
    }

} else {
		header('location: ../quantri.php');
	}
?>

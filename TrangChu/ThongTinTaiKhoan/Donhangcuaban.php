<?php
require_once "../ketnoi/ketnoi.php";
?>

<link rel="stylesheet" type="text/css" href="css/giohang.css" />
<link rel="stylesheet" type="text/css" href="css/muahang.css" />
<link rel="stylesheet" type="text/css" href="css/donhangct.css" />
<?php
$tkc = $_SESSION['tkc'];
if (isset($tkc)) {
    $sql = "SELECT dh.MaDongHo, sp.TenDongHo, sp.HinhAnh, kh.MaKH, dh.NgayDat, dh.NgayGiao, dh.SoLuong, dh.TongTien, dh.TinhTrangDonHang, dh.TinhTrangThanhToan
    FROM donhang dh
    INNER JOIN sanpham sp ON sp.MaDongHo = dh.MaDongHo
    INNER JOIN (SELECT * FROM khachhang WHERE TaiKhoan = '$tkc') kh ON kh.MaKH = dh.MaKH";

    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
?>
        <div class="prd-block">
            <h2>Đơn hàng của bạn (<?php $num_rows = mysqli_num_rows($query);
                                    echo $num_rows;  ?>)</h2>
            <div class="payment">
                <table border="0px" cellpadding="0px" cellspacing="0px" width="100%">
                    <?php
                    $number = 1;
                    while ($row = mysqli_fetch_array($query)) {
                        if ($number == 1) {
                            // Nếu là hàng đầu tiên, xuất hiện các cột tiêu đề
                    ?>
                            <tr id="invoice-bar">
                                <td width="5%">STT</td>
                                <td width="15%">Tên Sản phẩm</td>
                                <td width="10%">Hình ảnh</td>
                                <td width="15%">Ngày đặt hàng</td>
                                <td width="16%">Ngày giao hàng dự kiến</td>
                                <td width="5%">Số lượng</td>
                                <td width="15%">Số tiền cần thanh toán</td>
                                <td width="15%">Tình trạng thanh toán</td>
                                <td width="15%">Tình trạng đơn hàng</td>
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td><?php echo $number;
                                $number += 1; ?></td>
                            <td><a href="index.php?page_layout=Chitietsp&MaDongHo=<?php echo $row['MaDongHo'] ?>"><?php echo $row['TenDongHo']; ?> </td>
                            <td><a href="index.php?page_layout=Chitietsp&MaDongHo=<?php echo $row['MaDongHo'] ?>"><img src='../img/<?php echo $row['HinhAnh']; ?>'  alt="Ảnh sản phẩm"></td>
                            <td><?php echo $row['NgayDat'] ?></td>
                            <td><?php echo $row['NgayGiao'] ?></td>
                            <td><?php echo $row['SoLuong'] ?></td>
                            <td><?php echo number_format($row['TongTien']) . "đ" ?></td>
                            <td><?php
                            if (isset($row['TinhTrangThanhToan'])) {
                                if ($row['TinhTrangThanhToan'] == 'Đã thanh toán') {
                                    echo '<span class="my-text">' . $row['TinhTrangThanhToan'] . '</span>';
                                } else {
                                    echo 'Bạn cần thanh toán số tiền <span class="red-underline">' . number_format($row['TongTien']) . "đ" . '</span> khi nhận hàng' ;
                                }
                            }
                            
                                ?></td>
                                   
                            <td><?php
                                if (isset($row['TinhTrangDonHang'])) {
                                    echo  $row['TinhTrangDonHang'];
                                }
                                ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    <?php
    } else {
        echo "Bạn chưa có đơn hàng nào";
    }
} else {
    echo '<script>alert("Qúy khách vui lòng đăng nhập để sử dụng chức năng này");</script>';
    ?>
    <meta http-equiv="refresh" content="0;url=http://localhost:8081/demo1/TrangChu/index.php?page_layout=dangnhap">
<?php
}
?>
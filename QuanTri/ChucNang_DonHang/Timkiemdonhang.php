<?php
    include_once('../ketnoi/ketnoi.php');
    $timkiem=$_POST['id'];
    $sql = "SELECT dh.MaDonHang, dh.MaDongHo, dh.NgayDat, dh.NgayGiao, 
                    dh.SoLuong, dh.TongTien, dh.TinhTrangThanhToan, 
                    dh.TinhTrangDonHang, sp.TenDongHo, kh.TaiKhoan 
    FROM  donhang dh 
    INNER JOIN khachhang kh ON kh.MaKH=dh.MaKH
    INNER JOIN sanpham sp ON sp.MaDongHo=dh.MaDongHo
    WHERE sp.TenDongHo like '%$timkiem%' OR  kh.TaiKhoan like '%$timkiem%'
      OR  dh.TinhTrangThanhToan like '%$timkiem%' OR  dh.TinhTrangDonHang like '%$timkiem%'
    ";
    $query = mysqli_query($conn, $sql);
    $num=mysqli_num_rows($query);
    if($num>0){
    ?>
     <tr id="prd-bar">
            <td width="5%">STT</td>
            <td width="5%">Mã đơn hàng</td>
            <td width="20%">Tên Sản Phẩm</td>
            <td width="5%">Tài Khoản Khách Hàng</td>
            <td width="15%">Ngày Đặt</td>
            <td width="15%">Ngày Giao</td>
            <td width="5%">Số Lượng</td>
            <td width="10%">Tổng Tiền</td>
            <td width="20%">Tình Trạng Thanh Toán</td>
            <td width="5%">Tình Trạng Đơn Hàng</td>
            <td width="5%">Sửa</td>
            <td width="5%">Xóa</td>
    </tr>
        <?php
        $number=1;
        while ($row = mysqli_fetch_array($query)) {

        ?>
            <tr>
                <td><span><?php echo $number; ?></span></td>
                <td><span><?php echo $row['MaDonHang']; ?></span></td>
                <td class="l5"><a href="#"><?php echo $row['TenDongHo']; ?></a></td>
                <td class="l5"><a href="#"><?php echo $row['TaiKhoan']; ?></a></td>
                <td class="l5"><a href="#"><?php echo $row['NgayDat']; ?></a></td>
                <td class="l5"><a href="#"><?php echo $row['NgayGiao']; ?></a></td>
                <td class="l5"><a href="#"><?php echo $row['SoLuong']; ?></a></td>
                <td class="l5"><span class="price"><?php $format_number_1 = number_format($row['TongTien']);
                                    echo $format_number_1 ?></span></td>
                <td class="l5"><?php if($row['TinhTrangThanhToan']==0){
                                        echo 'Thanh toán khi nhận hàng';
                                     } else{
                                        echo 'Đã Thanh Toán';
                                     }
                
                ?></td>
                <td class="l5"><?php echo $row['TinhTrangDonHang'] ?></td>
                
                <td><a href="quantri.php?page_layout=suasp&masp=<?php echo $row['MaDongHo'] ?>"><span>Sửa</span></a></td>
                <td><a href="quantri.php?page_layout=xoasp&masp=<?php echo $row['MaDongHo'] ?>"><span>Xóa</span></a></td>
            </tr>
<?php
    }
}else{
    echo 'san pham khong ton tai';
}

?>

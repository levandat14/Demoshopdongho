<?php

include_once('../ketnoi/ketnoi.php');
if(isset($_SESSION['tk'])){
$sql = "SELECT dh.MaDonHang, dh.MaDongHo, dh.NgayDat, dh.NgayGiao, 
                dh.SoLuong, dh.TongTien, dh.TinhTrangThanhToan, 
                dh.TinhTrangDonHang, sp.TenDongHo, kh.TaiKhoan
         FROM  donhang dh
         INNER JOIN khachhang kh ON kh.MaKH=dh.MaKH
         INNER JOIN sanpham sp ON sp.MaDongHo=dh.MaDongHo
         ";
$query = mysqli_query($conn, $sql);
?>

<link rel="stylesheet" type="text/css" href="css/danhsachsp.css" />
<link rel="stylesheet" type="text/css" href="css/suasp.css" />
<script src="../ajax/jquery-3.6.0.min.js"></script>
<h2>quản lý sản phẩm</h2>
<input type="text" style="background-color: bisque;" id="timkiem" value="" placeholder="Tim San Pham..."></input>

<div id="main">

<table id="prds" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr id="prd-bar">
            <td width="5%">STT</td>
            <td width="5%">Mã đơn hàng</td>
            <td width="20%">Tên Sản Phẩm</td>
            <td width="5%">Tài Khoản Khách Hàng</td>
            <td width="15%">Ngày Đặt</td>
            <td width="17%">Ngày Giao</td>
            <td width="5%">Số Lượng</td>
            <td width="10%">Tổng Tiền</td>
            <td width="20%">Tình Trạng Thanh Toán</td>
            <td width="5%">Tình Trạng Đơn Hàng</td>
          
            <td width="5%">Sửa</td>
            <td width="5%">Xóa</td>
            <td width="5%">Chi Tiết</td>
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
                <td class="l5"><?php echo $row['TinhTrangThanhToan'];?></td>
                <td class="l5"><?php echo $row['TinhTrangDonHang'] ?></td>
                
                <td><a href="quantri.php?page_layout=suadonhang&madh=<?php echo $row['MaDonHang'] ?>"><span>Sửa</span></a></td>
                <td><a href="quantri.php?page_layout=xoadonhang&madh=<?php echo $row['MaDonHang'] ?>"><span>Xóa</span></a></td>
                <td><a href="quantri.php?page_layout=chitietdonhang&madh=<?php echo $row['MaDonHang'] ?>"><span>Chi Tiết</span></a></td>
            </tr>
        <?php
        $number+=1;
        }
        ?>
        <div id="dat"></div>
    </table>
    <script>
      
        $("#timkiem").keyup(function(){
            var timkiem=$(this).val();
           $.ajax({
               url:"ChucNang_DonHang/Timkiemdonhang.php",
               method:"POST",
               data:{id:timkiem},
               success:function(data){
                   $("#prds").html(data);
               }
           }
           )
        
        })

    </script>
        
</div>
<?php
} else {
		header('location: ../quantri.php');
	}
?>
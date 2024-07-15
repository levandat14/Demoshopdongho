<?php
if($_SESSION['tk']){
require_once('../ketnoi/ketnoi.php');
$sql = "SELECT * FROM sanpham ";
$query = mysqli_query($conn, $sql);
?>

<link rel="stylesheet" type="text/css" href="css/danhsachsp.css" />
<script src="../ajax/jquery-3.6.0.min.js"></script>
<h2>quản lý sản phẩm</h2>
<style>
    .timkiem{
        background-color:bisque;
    }
</style>
<input type="text" class="timkiem" id="timkiem" value="" placeholder="Tìm Sản Phẩm..."></input>

<div id="main">
    <p id="add-prd"><a href="quantri.php?page_layout=themsp"><span style="color: black;">thêm sản phẩm mới</span></a></p>
    <table id="prds" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr id="prd-bar">
            <td width="5%">ID</td>
            <td width="20%">Tên sản phẩm</td>
            <td width="10%">Giá</td>
            <td width="5%">Nhà San xuat</td>
            <td width="20%">Ảnh mô tả</td>
            <td width="10%">Số lượng</td>
            <td width="5%">Mã Loại</td>
            <td width="10%">Tình Trạng</td>
            <td width="10%">Bảo Hành</td>
            <td width="5%">Khuyến Mãi</td>
          
            <td width="5%">Sửa</td>
            <td width="5%">Xóa</td>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($query)) {

        ?>
            <tr>
                <td><span><?php echo $row['MaDongHo']; ?></span></td>
                <td class="l5"><a href="#"><?php echo $row['TenDongHo']; ?></a></td>
                <td class="l5"><span class="price"><?php $format_number_1 = number_format($row['GiaBan']);
                                    echo $format_number_1 ?></span></td>

                <td class="l5"><?php echo $row['MaNSX'] ?></td>
                

                <td><span class="thumb"><img width="60" src="../img/<?php echo $row['HinhAnh']; ?>" /></span></td>
                <td class="l5"><?php echo $row['SoLuong'] ?></td>
                <td class="l5"><?php echo $row['MaLoai'] ?></td>
                <td class="l5"><?php echo $row['TinhTrang'] ?></td>
                <td class="l5"><?php echo $row['BaoHanh'] ?></td>
                <td class="l5"><?php echo $row['KhuyenMai'] ?></td>
                
                <td><a href="quantri.php?page_layout=suasp&masp=<?php echo $row['MaDongHo'] ?>"><span>Sửa</span></a></td>
                <td><a href="quantri.php?page_layout=xoasp&masp=<?php echo $row['MaDongHo'] ?>"><span>Xóa</span></a></td>
            </tr>
        <?php
        }
    }else {
		header('location: ../quantri.php');
	}
        ?>
        <div id="dat"></div>
    </table>
    <script>
      
        $("#timkiem").keyup(function(){
            var timkiem=$(this).val();
           $.ajax({
               url:"ChucNang_SanPham/timkiemsanpham.php",
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

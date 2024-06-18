<link rel="stylesheet" type="text/css" href="css/themsp.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<link href="/LAB03/bootstrap/css/bootstrap.min.css">
<script src="../ckeditor/ckeditor.js"></script>
<link href="Site.css" rel="stylesheet" />
<?php
if($_SESSION['tk']){
ob_start();
require_once "../ketnoi/ketnoi.php";
$sqlloaisp = "SELECT * FROM loaisp ";
$queryloaisp = mysqli_query($conn, $sqlloaisp);

$sqlnsx = "SELECT * FROM nsx ";
$querynsx = mysqli_query($conn, $sqlnsx);
?>
<?php
$erro_maloaisp = null;
$erro_mansx = null;
$masp = $_GET['masp'];
$sqlsp = "SELECT * FROM sanpham where MaDongHo='$masp'";
$querysp = mysqli_query($conn, $sqlsp);
$rowsp = mysqli_fetch_array($querysp);


if (isset($_POST['btnsubmit'])) {
    $ten_dong_ho = $_POST['txtName'];
    //nsx
    if ($_POST['ma_nsx'] == 'khongco') {
        $erro_mansx = "(* Bạn chưa chọn nhà sản xuất *)";
    } else {
        $ma_nsx = $_POST['ma_nsx'];
    }

    $gia_ban = $_POST['txtgiaban'];

    $so_luong = $_POST['txtsoluong'];
    //loaisp
    if ($_POST['txtmaloaisp'] == 'khongco') {
        $erro_maloaisp = "(* Bạn chưa chọn loại sản phẩm *)";
    } else {
        $ma_loaisp = $_POST['txtmaloaisp'];
    }

    $tinh_trang = $_POST['txttinhtrang'];
    $bao_hanh = $_POST['txtbaohanh'];
    $khuyen_mai = $_POST['txtkhuyenmai'];
    $mo_ta = $_POST['txtmota'];
    //xử lý ảnh
    if (!empty($_FILES['hinh_anh']['name'])) {
        // Nếu có tệp ảnh mới, xử lý tệp ảnh như bình thường
        $anh_sp = $_FILES['hinh_anh']['name'];
        $tmp_name = $_FILES['hinh_anh']['tmp_name'];
        $target_directory = "../img/";
        $target_file = $target_directory . basename($anh_sp);
        move_uploaded_file($tmp_name, $target_file);
    } else {
        // Nếu không có tệp ảnh mới, sử dụng tên tệp ảnh hiện tại
        $anh_sp = isset($rowsp['HinhAnh']) ? $rowsp['HinhAnh'] : '';
    }
}

if (
    isset($ten_dong_ho) && isset($ma_nsx) && isset($gia_ban) && isset($anh_sp) && isset($so_luong) && isset($ma_loaisp)
    && isset($so_luong) && isset($tinh_trang) && isset($bao_hanh) && isset($khuyen_mai) && isset($mo_ta)

) {
    $sqlsp = "UPDATE sanpham SET TenDongHo='$ten_dong_ho', MaNSX='$ma_nsx', GiaBan='$gia_ban', HinhAnh='$anh_sp', SoLuong='$so_luong', MaLoai='$ma_loaisp',
         SoLuong='$so_luong', TinhTrang='$tinh_trang', BaoHanh='$bao_hanh', KhuyenMai='$khuyen_mai', MoTa='$mo_ta' where MaDongHo='$masp' ";
    $querysp = mysqli_query($conn, $sqlsp);
    header('location: quantri.php?page_layout=danhsachsp');
}
ob_end_flush();
?>
<form method="post" enctype="multipart/form-data" role="form">
    <div class="container">
        <div class="form-addsp">
            <div class="form-group">
                <h2>Sửa sản phẩm</h2>

            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Tên Đồng Hồ</lable>
                </div>
                <div class="lbinput">
                    <input required type="text" class="form-control" name="txtName" value="<?php echo $rowsp['TenDongHo']; ?> " />
                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Chọn nhà sản xuất</lable>
                    <span style="color:red;"><?php echo isset($erro_mansx) ? $erro_mansx : "" ?></span>
                </div>
                <div class="lbinput">

                    <select name="ma_nsx" class="form-control">
                        <option value="khongco">---Chọn Loại---</option>
                        <?php while ($rownsx = mysqli_fetch_array($querynsx)) { ?>
                            <?php
                            $selected = ($rownsx['MaNSX'] == $rowsp['MaNSX']) ? 'selected' : ''; // Kiểm tra nếu MaNSX trùng khớp với MaNSX của sản phẩm cần sửa
                            ?>
                            <option value="<?php echo $rownsx['MaNSX']; ?>" <?php echo $selected; ?>>
                                <?php echo $rownsx['TenNSX']; ?>
                            </option>
                        <?php } ?>
                    </select>



                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Giá bán</lable>
                </div>
                <div class="lbinput">
                    <input required type="text" class="form-control" name="txtgiaban" value="<?php echo $rowsp['GiaBan']; ?> " />
                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <label>Ảnh hiện tại</label>
                    <span style="color: red;">
                        <?php if (isset($error_anh_sp)) {
                            echo $error_anh_sp;
                        } ?>
                    </span>
                    <!-- Hiển thị ảnh hiện tại -->
                    <?php if (isset($rowsp['HinhAnh'])) : ?>
                        <img src="../img/<?php echo $rowsp['HinhAnh']; ?>" alt="Hình hiện tại" width="40" height="40">
                    <?php else : ?>
                        <span>Không có ảnh hiện tại</span>
                    <?php endif; ?>
                </div>
                <!-- Hiển thị tên tệp ảnh hiện tại -->
                <div class="lbinput">
                    <label>Tên ảnh</label>
                    <input type="text" value="<?php echo isset($rowsp['HinhAnh']) ? $rowsp['HinhAnh'] : ''; ?>" readonly>
                </div>
                <!-- Cho phép người dùng chọn tệp mới nếu muốn thay đổi -->
                <div class="lbinput">
                    <input type="file" name="hinh_anh" />
                </div>
            </div>

            <div class="form-group">
                <div class="lbtitle">
                    <lable>Số lượng</lable>
                </div>
                <div class="lbinput">
                    <input required type="text" class="form-control" name="txtsoluong" value="<?php echo $rowsp['SoLuong']; ?> " />
                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Chọn loại sản phẩm</lable>
                    <span style="color:red;"><?php echo isset($erro_maloaisp) ?  $erro_maloaisp : "" ?></span>
                </div>
                <div class="lbinput">
                    <select name="txtmaloaisp" class="form-control">
                        <option value="khongco" selected>---Chọn Loại---</option>
                        <?php while ($rowloaisp = mysqli_fetch_array($queryloaisp)) { ?>
                            <?php
                            $selected = ($rowloaisp['MaLoai'] == $rowsp['MaLoai']) ? 'selected' : ''; // Kiểm tra nếu MaNSX trùng khớp với MaNSX của sản phẩm cần sửa
                            ?>
                            <option value="<?php echo $rowloaisp['MaLoai'];  ?> " <?php echo $selected; ?>>
                                <?php echo $rowloaisp['TenLoai'];  ?> </option>
                        <?php }
                        ?>
                    </select>

                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Tình trạng sản phẩm</lable>
                </div>
                <div class="lbinput">
                    <input required type="text" class="form-control" name="txttinhtrang" value="<?php echo $rowsp['TinhTrang']; ?> " />
                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Bảo hành</lable>
                </div>
                <div class="lbinput">
                    <input required type="text" class="form-control" name="txtbaohanh" value="<?php echo $rowsp['BaoHanh'] ?> " />
                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Khuyến mãi</lable>
                </div>
                <div class="lbinput">
                    <input required placeholder="Nhập theo số VD: 1 ->10% && 2->20%" type="text" class="form-control" name="txtkhuyenmai" value="<?php echo $rowsp['KhuyenMai'] ?> " />
                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <label for="txtmota">Mô tả sản phẩm</label>
                </div>
                <div class="lbinput">
                    <!-- Sử dụng thẻ <textarea> để hiển thị mô tả sản phẩm -->
                    <textarea required name="txtmota" id="txtmota" class="form-control" cols="21" rows="5"><?php echo isset($rowsp['MoTa']) ? $rowsp['MoTa'] : ''; ?></textarea>
                </div>
                <!-- Kích hoạt CKEditor cho trường mô tả -->
                <script>
                    CKEDITOR.replace('txtmota');
                </script>
            </div>


            <div class="form-group">
                <div class="submit">
                    <input type="submit" class="btn btn-success" name="btnsubmit" value="Sửa sản phẩm" />
                </div>
            </div>
        </div>
    </div>
    <?php 
}else {
    header('location: ../quantri.php');
}
    ?>
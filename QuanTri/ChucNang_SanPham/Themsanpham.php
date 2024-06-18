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
require_once "../ketnoi/ketnoi.php";
$sqlloaisp = "SELECT * FROM loaisp ";
$queryloaisp = mysqli_query($conn, $sqlloaisp);
?>

<?php
$sqlnsx = "SELECT * FROM nsx ";
$querynsx = mysqli_query($conn, $sqlnsx);
?>
<?php
$erro_maloaisp=null;
$erro_mansx=null;
$error_anh_sp=null;
    if(isset($_POST['btnsubmit'])){
        $ten_dong_ho=$_POST['txtName'];
        //nsx
        if($_POST['ma_nsx']=='khongco'){
            $erro_mansx="(* Bạn chưa chọn nhà sản xuất *)";
        }
        else
        {
            $ma_nsx=$_POST['ma_nsx'];
        }

        $gia_ban=$_POST['txtgiaban'];
        //ảnh
        if($_FILES['hinh_anh']['name'] == ''){
            $error_anh_sp = "(*Bạn chưa chọn ảnh*)";
        }
        else{
            $anh_sp = $_FILES['hinh_anh']['name'];
            $tmp_name = $_FILES['hinh_anh']['tmp_name'];
        }

        $so_luong=$_POST['txtsoluong'];
        //loaisp
        if($_POST['txtmaloaisp']=='khongco'){
            $erro_maloaisp="(* Bạn chưa chọn loại sản phẩm *)";
        }
        else
        {
            $ma_loaisp=$_POST['txtmaloaisp'];
        }

        $tinh_trang=$_POST['txttinhtrang'];
        $bao_hanh=$_POST['txtbaohanh'];
        $khuyen_mai=$_POST['txtkhuyenmai'];
        $mo_ta=$_POST['txtmota'];
        $target_directory = "../img/"; // Thư mục đích
        $target_file = $target_directory . basename($anh_sp); // Đường dẫn tệp đích
       
        if(isset($ten_dong_ho) && isset($ma_nsx) && isset($gia_ban) && isset($anh_sp) && isset($so_luong) && isset($ma_loaisp)
          && isset($tinh_trang) && isset($bao_hanh) && isset($khuyen_mai) && isset($mo_ta)){
             move_uploaded_file($tmp_name, $target_file);
            $sqlsp="INSERT INTO sanpham(TenDongHo,MaNSX, GiaBan, HinhAnh, SoLuong,MaLoai, TinhTrang, BaoHanh, KhuyenMai,MoTa) VALUES 
            ( '$ten_dong_ho','$ma_nsx','$gia_ban','$anh_sp', ' $so_luong','$ma_loaisp', '$tinh_trang','$bao_hanh', '$khuyen_mai', '$mo_ta') ";
            $quyerysp=mysqli_query($conn,$sqlsp);
            header('location: quantri.php?page_layout=danhsachsp');
        }
    }

?>



<form method="post" enctype="multipart/form-data"  role="form">
    <div class="container">
        <div class="form-addsp">
            <div class="form-group">
                <h2>thêm mới loại sản phẩm</h2>

            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Tên Đồng Hồ</lable>
                </div>
                <div class="lbinput">
                    <input required type="text" class="form-control" name="txtName" value="<?php echo isset($_POST['txtName']) ? $_POST['txtName'] : ""; ?> " />
                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Chọn nhà sản xuất</lable>
                    <span style="color:red;"><?php echo $erro_mansx;?></span>
                </div>
                <div class="lbinput">
                    <select name="ma_nsx" class="form-control">
                        <option value="khongco" selected>---Chọn Loại---</option>
                        <?php while ($rownsx = mysqli_fetch_array($querynsx)) { ?>
                            <option  value="<?php echo $rownsx['MaNSX'];  ?> "> <?php echo $rownsx['TenNSX'];  ?> </option>
                        <?php }?>
                    </select>

                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Giá bán</lable>
                </div>
                <div class="lbinput">
                    <input required type="number" class="form-control" name="txtgiaban" value="<?php echo isset($_POST["txtgiaban"]) ? $_POST["txtgiaban"] : ""; ?> " />
                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Đường dẫn hình</lable>
                    <span style="color:red;"><?php if(isset($error_anh_sp)){ echo $error_anh_sp;}?></span>
                </div>
                <div class="lbinput">
                    <input type="file" name="hinh_anh" />
                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Số lượng</lable>
                </div>
                <div class="lbinput">
                    <input required type="number" class="form-control" name="txtsoluong" value="<?php echo isset($_POST["txtsoluong"]) ? $_POST["txtsoluong"] : ""; ?> " />
                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Chọn loại sản phẩm</lable>
                    <span style="color:red;"><?php echo $erro_maloaisp;?></span>
                </div>
                <div class="lbinput">
                    <select name="txtmaloaisp" class="form-control">
                        <option value="khongco" selected>---Chọn Loại---</option>
                        <?php while ($rowloaisp = mysqli_fetch_array($queryloaisp)) { ?>
                            <option value="<?php echo $rowloaisp['MaLoai'];  ?> "> <?php echo $rowloaisp['TenLoai'];  ?> </option>
                        <?php }$erro_maloaisp ?>
                    </select>

                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Tình trạng sản phẩm</lable>
                </div>
                <div class="lbinput">
                    <input required type="text" class="form-control" name="txttinhtrang" value="<?php echo isset($_POST["txttinhtrang"]) ? $_POST["txttinhtrang"] : ""; ?> " />
                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Bảo hành</lable>
                </div>
                <div class="lbinput">
                    <input required type="text" class="form-control" name="txtbaohanh" value="<?php echo isset($_POST["txtbaohanh"]) ? $_POST["txtbaohanh"] : ""; ?> " />
                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Khuyến mãi</lable>
                </div>
                <div class="lbinput">
                    <input  placeholder="Nhập theo số VD: 1 ->10% && 2->20%"  type="number" class="form-control" name="txtkhuyenmai" value="<?php echo isset($_POST["txtkhuyenmai"]) ? $_POST["txtkhuyenmai"] : ""; ?> " />
                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Mô tả sản phẩm</lable>
                </div>
                <div class="lbinput">
                    <textarea required name="txtmota" class="form-control" cols="21" form-groups="18" value="<?php echo isset($_POST["txtmota"]) ? $_POST["txtmota"] : ""; ?> "></textarea>
                </div>
                <script>

           CKEDITOR.replace( 'txtmota' );

       </script>  
            </div>

            <div class="form-group">
                <div class="submit">
                    <input type="submit" class="btn btn-success" name="btnsubmit" value="Thêm sản phẩm" />
                </div>
            </div>
        </div>
    </div>
</form>
<?php
}
else {
    header('location: ../quantri.php');
}
?>
<link rel="stylesheet" type="text/css" href="css/themsp.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<link href="/LAB03/bootstrap/css/bootstrap.min.css">
<script src="../ckeditor/ckeditor.js"></script>
<link href="Site.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<?php
require_once "../ketnoi/ketnoi.php";
if(isset($_SESSION['tk'])){
$sqldh = "SHOW COLUMNS FROM donhang WHERE Field = 'TinhTrangDonHang'";
$querydh = mysqli_query($conn, $sqldh);
$rowdh = mysqli_fetch_assoc($querydh);
$enum_str = $rowdh['Type'];

$sqltt = "SHOW COLUMNS FROM donhang WHERE Field = 'TinhTrangThanhToan'";
$querytt = mysqli_query($conn, $sqltt);
$rowtt = mysqli_fetch_assoc($querytt);
$enum_str_tt = $rowtt['Type'];

$madh = $_GET['madh'];
$sql = "SELECT dh.MaDonHang, dh.MaDongHo, dh.NgayDat, dh.NgayGiao, 
                dh.SoLuong, dh.TongTien, dh.TinhTrangThanhToan, 
                dh.TinhTrangDonHang, sp.TenDongHo, kh.TaiKhoan
         FROM  donhang dh
         INNER JOIN khachhang kh ON kh.MaKH=dh.MaKH
         INNER JOIN sanpham sp ON sp.MaDongHo=dh.MaDongHo
         WHERE dh.MaDonHang='$madh'
         ";
$query = mysqli_query($conn, $sql);
$row1 = mysqli_fetch_array($query);

if (isset($_POST['btnsubmit'])) {  
    $ngaygiao = isset($_POST['txtngaygiao']) ? $_POST['txtngaygiao'] : null;
    if ($ngaygiao != null) {
        $ngaygiao_formatted = date('Y-m-d', strtotime($ngaygiao));
    }

    $tinhtrangthanhtoan = $_POST['txttinhtrangthanhtoan'];
    $tinhtrangdonhang = $_POST['txttinhtrangdonhang'];


if(isset($tinhtrangthanhtoan))
 {
    $sqlsp = "UPDATE donhang SET NgayGiao = ";
    $sqlsp .= $ngaygiao != null ? "'$ngaygiao_formatted'" : "NULL";
    $sqlsp .= ", TinhTrangThanhToan = '$tinhtrangthanhtoan', TinhTrangDonHang = '$tinhtrangdonhang' WHERE MaDonHang = '$madh'";
    $querysp = mysqli_query($conn, $sqlsp);
    header('location: quantri.php?page_layout=danhsachdonhang');
}
}

?>
<form method="post" enctype="multipart/form-data" role="form">
    <div class="container">
        <div class="form-addsp">
            <div class="form-group">
                <h2>Sửa đơn hàng</h2>

            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Mã Đơn Hàng</lable>
                </div>
                <div class="lbinput">
                    <input required disabled type="text" class="form-control" name="txtmadonhang" value="<?php echo $row1['MaDonHang']; ?> " />
                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Tài Khoản Khách Hàng</lable>
                </div>
                <div class="lbinput">
                    <input required disabled type="text" class="form-control" name="txttaikhoankhachhang" value="<?php echo $row1['TaiKhoan']; ?> " />
                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Ngày Đặt</lable>
                </div>
                <div class="lbinput">
                    <input required disabled type="text" class="form-control" name="txtngaydat" value="<?php echo $row1['NgayDat']; ?> " />
                </div>
            </div>
            <div class="form-group">
                <div class="lbtitle">
                    <lable>Ngày Giao</lable>
                </div>
                <div class="lbinput">
                    <script>
                        $(function() {
                            $("#datepicker").datepicker();
                        });
                    </script>
                    </head>

                    <body>
                    <p>Date: <input type="text" name="txtngaygiao" id="datepicker" value="<?php echo isset($row1['NgayGiao']) ? date('Y-m-d', strtotime($row1['NgayGiao'])) : ''; ?>"></p>

                        </p>
                    </body>

                    </html>
                </div>
                <div class="form-group">
                    <div class="lbtitle">
                        <lable>Số Lượng</lable>
                    </div>
                    <div class="lbinput">
                        <input required disabled type="text" class="form-control" name="txtsoluong" value="<?php echo $row1['SoLuong']; ?> " />
                    </div>
                </div>
                <div class="form-group">
                    <div class="lbtitle">
                        <lable>Tổng Tiền</lable>
                    </div>
                    <div class="lbinput">
                        <input required type="text" disabled class="form-control" name="txttongtien" value="<?php echo number_format($row1['TongTien']); ?> " />
                    </div>
                </div>
                <div class="form-group">
                    <div class="lbtitle">
                        <lable>Tình Trạng Thanh Toán</lable>
                        <select name="txttinhtrangthanhtoan" class="form-control">
                            <option value="khongco">---Chọn Loại---</option>
                            <?php
                            // Phân tích chuỗi ENUM để lấy các giá trị
                            preg_match_all("/'([^']+)'/", $enum_str_tt, $matches);
                            $enums = $matches[1];
                            // Tạo các tùy chọn trong trường select
                            foreach ($enums as $enum) {
                                // Kiểm tra xem giá trị enum có trùng với giá trị hiện tại trong hàng dữ liệu không
                                $selected1 = ($row1['TinhTrangThanhToan'] === $enum) ? 'selected' : '';
                                // Tạo tùy chọn với giá trị và kiểm tra lựa chọn
                                echo '<option value="' . $enum . '" ' . $selected1 . '>' . $enum . '</option>';
                            }
                            ?>
                            ?>
                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <div class="lbtitle">
                        <lable>Tình Trạng Đơn Hàng</lable>
                        <select name="txttinhtrangdonhang" class="form-control">
                            <option value="khongco">---Chọn Loại---</option>
                            <?php
                            // Phân tích chuỗi ENUM để lấy các giá trị
                            preg_match_all("/'([^']+)'/", $enum_str, $matches);
                            $enums = $matches[1];
                            // Tạo các tùy chọn trong trường select
                            foreach ($enums as $enum) {
                                // Kiểm tra xem giá trị enum có trùng với giá trị hiện tại trong hàng dữ liệu không
                                $selected = ($row1['TinhTrangDonHang'] === $enum) ? 'selected' : '';
                                // Tạo tùy chọn với giá trị và kiểm tra lựa chọn
                                echo '<option value="' . $enum . '" ' . $selected . '>' . $enum . '</option>';
                            }
                            
                            ?>
                            ?>
                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <div class="submit">
                        <input type="submit" class="btn btn-success" name="btnsubmit" value="Sửa sản phẩm" />
                    </div>
                </div>
            </div>
        </div>
        <?php
} else {
		header('location: ../quantri.php');
	}
?>
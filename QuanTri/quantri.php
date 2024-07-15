<?php
session_start();
include_once('../ketnoi/ketnoi.php');
if (isset($_SESSION['tk'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mobile Shop - Trang chủ quản trị</title>
        <link rel="stylesheet" type="text/css" href="css/quantri.css" />
    </head>

    <body>


        <div id="wrapper">
            <div id="header">
                <div id="navbar">
                    <ul>
                        <li id="admin-home"><a href="quantri.php?page_layout=doanhthu">Doanh Thu</a></li>
                        <li><a href="quantri.php?page_layout=nsx">Nhà Sản Xuất</a></li>
                        <li><a href="quantri.php?page_layout=loaisp">Loai sản phẩm</a></li>
                        <li><a href="quantri.php?page_layout=danhsachsp">sản phẩm</a></li>
                        <li><a href="quantri.php?page_layout=danhsachdonhang">Quản Lý đơn hàng</a></li>
                        <?php require("./ChucNang_TaikhoanAdmin/Kiemtrataikhoan.php");
                            if($row['LoaiTK']==1){
                               echo '<li><a href="quantri.php?page_layout=dangkitkadmin">Admin</a></li>';
                            }
                        ?>  
                        <li><a href="ChucNang_DangNhap/Dangxuat.php"><button style="color:black;">Đăng xuất</button>
                            </span></a></li>
                    </ul>
                </div>

            </div>
            <div id="body">
                <?php
                if (isset($_GET['page_layout'])) {
                    switch ($_GET['page_layout']) {
                        case 'danhsachsp':
                            include_once('./ChucNang_SanPham/Danhsachsanpham.php');
                            break;
                        case 'suasp':
                            include_once('./ChucNang_SanPham/Suasanpham.php');
                            break;
                        case 'xoasp':
                            include_once('./ChucNang_SanPham/Xoasp.php');
                            break;
                        case 'loaisp':
                            include_once('./ChucNang_LoaiSanPham/AjaxLoaisanpham.php');
                            break;
                        case 'nsx':
                            include_once('./ChucNang_NhaSanXuat/AjaxNhasanxuat.php');
                            break;
                        case 'themsp':
                            include_once('./ChucNang_SanPham/Themsanpham.php');
                            break;
                        case 'dangkitkadmin':
                            include_once('./ChucNang_TaikhoanAdmin/Ajaxtaikhoanadmin.php');
                            break;
                        case 'themtkadmin':
                            include_once('./ChucNang_TaikhoanAdmin/ThemtaikhoanAdmin.php');
                            break;
                        case 'danhsachdonhang':
                            include_once('./ChucNang_DonHang/Danhsachdonhang.php');
                            break;
                        case 'suadonhang':
                            include_once('./ChucNang_DonHang/Suadonhang.php');
                            break;
                         case 'xoadonhang':
                            include_once('./ChucNang_DonHang/Xoadonhang.php');
                            break;
                        case 'chitietdonhang':
                            include_once('./ChucNang_DonHang/Chitietdonhang.php');
                            break;
                        case 'doanhthu':
                            include_once('./ChucNang_DoanhThu/Thongkedoanhthu.php');
                            break;
                    }
                } else {
                    include_once('./ChucNang_DoanhThu/Thongkedoanhthu.php');
                }
                ?>

            </div>
            <div id="footer">
            <div id="footer-info">
                <h4>Trường Đại Học Công Nghệ TP.HCM </h4>
                <p><span>Nhóm 102:</span> Gồm 2 thành viên | <span>Đạt, Quang</span></p>
                <p><span>Đề Tài:</span> Xây dựng website kinh doanh đồng hồ | <span>Hotline</span> 099999999</p>
            </div>
        </div>
        </div>
    </body>

    </html>
<?php
} else {
    header("location: ChucNang_DangNhap/Dangnhap.php");
}
?>
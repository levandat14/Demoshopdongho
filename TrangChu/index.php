<?php
session_start();
require_once('../ketnoi/ketnoi.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="css/index.css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casio Shop - Website Bán Hàng Trực Tuyến</title>
    <link rel="stylesheet" type="text/css" href="css/trangchu.css" />
    <link rel="stylesheet" type="text/css" href="css/dangnhap.css" />
    <link rel="stylesheet" type="text/css" href="css/loc.css">
    <!--bd-->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/font-slider.css" rel="stylesheet" />
    <!-- jQuery and Modernizr-->
    <script src="css/jquery-2.1.1.js"></script>
    <script src="css/bootstrap.min.js"></script>
    <!-- ajax-->
    <script src="../ajax/jquery-3.6.0.min.js"></script>
    <!--kt-->
    </script>
</head>

<body>

    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Header -->
        <div id="header">
            <div id="search-bar">
                <!--Tai khoan-->
                <?php if (isset($_SESSION['tkc'])) { ?>
                    <div class="dropdown">
                        <button class="btn btn-default"><span style="color: black;"><?php if (isset($_SESSION['tkc'])) {
                                                                                        echo 'Xin chào:' . $_SESSION['tkc'];
                                                                                    } ?></span></button>
                        <div class="dropdown-content">
                            <p><a href="index.php?page_layout=thongtin">Thông Tin Của Bạn</a></p>
                            <p><a href="index.php?page_layout=donhang">Đơn hàng Của Bạn (<?php include_once("./ThongTinTaiKhoan/Countdonhang.php"); ?>)</a></p>
                            <p><a href="index.php?page_layout=dangxuat">Đăng Xuất</a></p>
                        </div>
                    </div>
                <?php } else {
                ?>
                    <p><button class="btn"><a href="index.php?page_layout=dangnhap">Đăng Nhập</a></button></p>
                <?php

                } ?>
                <!--Giỏ hàng-->
            </div>

            <div id="main-bar">
                <div id="logo"><a href="index.php"><img src="Img/logo2.png" /></a></div>
                <div id="banner"></div>
            </div>

            <marquee behavior="alternate" width="10%">>></marquee><a>Xin Chào Qúy Khách <?php if (isset($_SESSION['tkc'])) {
                                                                                            echo $_SESSION['tkc'];
                                                                                        } else {
                                                                                        } ?></a>
            <marquee behavior="alternate" width="10%">
                << </marquee>


                    <div id="navbar">
                        <ul>
                            <li id="menu-home"><a href="index.php">trang chủ</a></li>

                            <li><a href="#" id="gioithieu">giới thiệu</a></li>
                            <li><a href="index.php?page_layout=dichvu">dịch vụ</a></li>
                            <li><a href="index.php?page_layout=lienhe">liên hệ</a></li>
                            <li><a href="index.php?page_layout=giohang">
                                    <img src="Img/giohang.png" width="23px" /><b style="color:black;">Giỏ Hàng(<?php
                                                                                                                if (isset($_SESSION['giohang'])) {
                                                                                                                    echo count($_SESSION['giohang']);
                                                                                                                } else {
                                                                                                                    echo 0;
                                                                                                                }
                                                                                                                ?>)</b>

                                </a></li>
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                            <!-- The form -->
                            <form id="searchForm" class="example">
                                <input type="text" style="background-color: bisque;"  id="timkiem" placeholder="Search.." name="search">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                            <div id="search"></div>
                        </ul>
                    </div>
        </div>
        <!-- ajax tìm kiếm -->
        <script>
            // bắt sự kiện nút button
            $("#searchForm").on('submit', function(event) {
            event.preventDefault();
            var timkiem = $("#timkiem").val();
            if (timkiem.trim() !== '') {
                $.ajax({
                url: "ChucNang_TimKiem/Timkiemtheosanpham.php",
                method: "POST",
                data: { id: timkiem },
                success: function(data) {
                 window.location.href = "index.php?page_layout=timkiemtheosanpham&timkiem=" + encodeURIComponent(timkiem);
                }
                });
            } else {
                alert("Từ khóa bắt buộc!"); 
            }
            });
             // bắt sự kiện nút enter
            $("#timkiem").keypress(function(event) {
                if (event.keyCode === 13) { 
                    event.preventDefault(); 
                    var timkiem = $("#timkiem").val();
                    if (timkiem.trim() !== '') {
                        $.ajax({
                            url: "ChucNang_TimKiem/Timkiemtheosanpham.php",
                            method: "POST",
                            data: {
                                id: timkiem
                            },
                            success: function(data) {
                               window.location.href = "index.php?page_layout=timkiemtheosanpham&timkiem=" + encodeURIComponent(timkiem);
                            }
                        });
                    }
                    else {
                        alert("Từ khóa bắt buộc!"); 
                         }
                }
            });
        </script>
        <!-- Body -->
        <div id="body">
            <!-- Left Column -->
            <div id="l-col">
                <!--Tư vấn-->
                <?php
                include_once('./ChucNang_SanPham/Danhsachtheoloaisp.php');
                ?>
                <!--Danh mục-->
                <?php
                include_once('./ChucNang_SanPham/danhsachnsx.php');
                ?>
                <!--Quảng cáo-->

                <!--Thống kê-->

            </div>
            <div id="r-col">
                <!--slideshow-->
                <div class="w3-content w3-section" style="max-width:720px">
                    <img class="mySlides" src="Img/bn1.jpg" style="width:100%">
                    <img class="mySlides" src="Img/bn3.jpg" style="width:100%">
                    <img class="mySlides" src="Img/bn4.jpg" style="width:100%">
                </div>

                <script>
                    var myIndex = 0;
                    carousel();

                    function carousel() {
                        var i;
                        var x = document.getElementsByClassName("mySlides");
                        for (i = 0; i < x.length; i++) {
                            x[i].style.display = "none";
                        }
                        myIndex++;
                        if (myIndex > x.length) {
                            myIndex = 1
                        }
                        x[myIndex - 1].style.display = "block";
                        setTimeout(carousel, 2000);
                    }
                </script>

                <div id="main">
                    <div id="dat"></div>
                    <?php
                    if (isset($_GET['page_layout'])) {
                        switch ($_GET['page_layout']) {

                            case 'dichvu':
                                include_once('Dichvu.php');
                                break;
                            case 'lienhe':
                                include_once('lienhe.php');
                                break;
                            case 'Chitietsp':
                                include_once('./ChucNang_SanPham/Chitietsp.php');
                                break;
                            case 'sanphamtheonsx':
                                include_once('./ChucNang_SanPham/sanphamtheonsx.php');
                                break;
                            case 'sanphamtheoloaisp':
                                include_once('./ChucNang_SanPham/sanphamtheoloaisp.php');
                                break;
                            case 'donhang':
                                include_once('./ThongTinTaiKhoan/Donhangcuaban.php');
                                break;
                            case 'giohang':
                                include_once('./ChucNang_GioHang/Giohang.php');
                                break;
                            case 'dangnhap':
                                include_once('./ChucNang_Dangnhap/Dangnhap.php');
                                break;
                            case 'dangxuat':
                                include_once('./ChucNang_Dangnhap/Dangxuat.php');
                                break;
                            case 'muahang':
                                include_once('./ChucNang_MuaHang/Muahang.php');
                                break;
                            case 'thongtin':
                                include_once('./ThongTinTaiKhoan/Thongtin.php');
                                break;
                            case 'doimatkhaukh':
                                include_once('./ThongTinTaiKhoan/DoiMatKhauKH.php');
                                break;
                            case 'timkiemtheosanpham':
                                include_once('./ChucNang_TimKiem/Timkiemtheosanpham.php');
                                break;

                            default:
                                include_once('./ChucNang_SanPham/Sanphammoi.php');
                                include_once('./ChucNang_SanPham/sanphamgshork.php');
                                include_once('./ChucNang_SanPham/sanphamgiamgia.php');
                        }
                    } else {
                        include_once('./ChucNang_SanPham/Sanphammoi.php');
                        include_once('./ChucNang_SanPham/sanphamgshork.php');
                        include_once('./ChucNang_SanPham/sanphamgiamgia.php');
                    }
                    ?>
                </div>
            </div>
            <!-- End Right Column -->
            <script>
                $("#gioithieu").click(function() {
                    $("#dat").load("Gioithieu.php");
                });
            </script>
            <script type="text/javascript" src="https://ahachat.com/customer-chats/customer_chat_IIFnyJ7uWi61bc688aaeab4.js"></script>
            <img src="./Img/dongho.png" />
        </div>
        <!-- End Body -->
        <!-- Footer -->
        <div id="footer">
            <div id="footer-info">
                <h4>Trường Đại Học Công Nghệ TP.HCM </h4>
                <p><span>Nhóm 102:</span> Gồm 2 thành viên | <span>Đạt, Quang</span></p>
                <p><span>Đề Tài:</span> Xây dựng website kinh doanh đồng hồ | <span>Hotline</span> 099999999</p>
            </div>
        </div>
        <!-- End Footer -->
    </div>
    <!-- End Wrapper -->

</body>

</html>
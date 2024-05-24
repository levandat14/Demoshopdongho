-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 06:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdongho`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `TenDangNhap` varchar(50) NOT NULL,
  `MatKhau` varchar(255) NOT NULL,
  `LoaiTK` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `TenDangNhap`, `MatKhau`, `LoaiTK`) VALUES
(13, 'dat', '$2y$10$5l52Ti0rrayrMJNlm9Qhj.OBoVT4KUqSDjd9JUF1FmD349jayUq.u', '1'),
(16, 'thu', '$2y$10$50L1QgZj1rLx9Etd49Js4OfxfuLQqCiNQvkUozZDFuVhLH6hC7Ia2', '0');

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `MaDonHang` int(11) NOT NULL,
  `MaDongHo` int(11) NOT NULL,
  `MaKH` int(11) NOT NULL,
  `NgayDat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `NgayGiao` date DEFAULT NULL,
  `SoLuong` int(11) NOT NULL,
  `TongTien` int(11) NOT NULL,
  `TinhTrangThanhToan` enum('Đã thanh toán','Chưa thanh toán') NOT NULL DEFAULT 'Chưa thanh toán',
  `TinhTrangDonHang` enum('Đã đóng gói','Đã vận chuyển','Đã giao thành công') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`MaDonHang`, `MaDongHo`, `MaKH`, `NgayDat`, `NgayGiao`, `SoLuong`, `TongTien`, `TinhTrangThanhToan`, `TinhTrangDonHang`) VALUES
(57, 5, 70, '2024-04-18 16:41:59', NULL, 1, 650000, 'Chưa thanh toán', 'Đã đóng gói');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKH` int(11) NOT NULL,
  `TenKH` varchar(100) NOT NULL,
  `TaiKhoan` varchar(50) NOT NULL,
  `MatKhau` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `DiaChi` varchar(200) NOT NULL,
  `SDT` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MaKH`, `TenKH`, `TaiKhoan`, `MatKhau`, `Email`, `DiaChi`, `SDT`) VALUES
(57, 'levandar', 'dat1234', '202cb962ac59075b964b07152d234b70', 'dat@gmail.com', '119 an bình, bình dươngg', '0901914933'),
(70, 'lê văn đạt', 'dat', '202cb962ac59075b964b07152d234b70', 'dat@gmail.com', ' 119 an bình, bình dương', '0901914933');

-- --------------------------------------------------------

--
-- Table structure for table `loaisp`
--

CREATE TABLE `loaisp` (
  `MaLoai` int(11) NOT NULL,
  `TenLoai` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loaisp`
--

INSERT INTO `loaisp` (`MaLoai`, `TenLoai`) VALUES
(66, 'Đồng Hồ Đeo Tay '),
(67, 'Đồng Hồ Treo Tường'),
(68, 'Đồng Hồ Thông Minh');

-- --------------------------------------------------------

--
-- Table structure for table `nsx`
--

CREATE TABLE `nsx` (
  `MaNSX` int(11) NOT NULL,
  `TenNSX` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nsx`
--

INSERT INTO `nsx` (`MaNSX`, `TenNSX`) VALUES
(81, 'G-SHOCK'),
(82, 'CURNON'),
(83, 'DYOSS'),
(84, 'KASHI'),
(85, 'ETERNO');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `MaDongHo` int(11) NOT NULL,
  `TenDongHo` varchar(200) NOT NULL,
  `MaNSX` int(11) NOT NULL,
  `GiaBan` int(100) NOT NULL,
  `HinhAnh` varchar(100) DEFAULT NULL,
  `SoLuong` int(11) NOT NULL,
  `MaLoai` int(11) NOT NULL,
  `TinhTrang` varchar(15) NOT NULL,
  `BaoHanh` varchar(20) NOT NULL,
  `KhuyenMai` int(20) DEFAULT NULL,
  `MoTa` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`MaDongHo`, `TenDongHo`, `MaNSX`, `GiaBan`, `HinhAnh`, `SoLuong`, `MaLoai`, `TinhTrang`, `BaoHanh`, `KhuyenMai`, `MoTa`) VALUES
(1, 'Đồng hồ Nam SDK05004K0      ', 82, 320000, 'dong-ho-nam-mvw-ms068-03-2.jpg ', 1000, 66, 'Mới 100%     ', '12 Tháng     ', 1, '<p>Sang trọng v&agrave; đẳng cấp Đồng hồ Orient đem đến những sản phẩm ấn tượng chinh phục người nh&igrave;n một c&aacute;ch nhanh ch&oacute;ng. Đồng hồ Orient với những chất liệu cao cấp b&oacute;ng bẩy n&acirc;ng tầm đẳng cấp cho người sở hữu, ph&ugrave; hợp với doanh nh&acirc;n th&agrave;nh đạt, d&acirc;n văn ph&ograve;ng hay c&aacute;c gi&aacute;m đốc c&ocirc;ng ty. Phong c&aacute;ch thời thượng, sang trọng đầy sức thu h&uacute;t đến từ đồng hồ Orient chắc chắn sẽ khiến bạn lu&ocirc;n h&atilde;nh diện với những người xung quanh.</p>'),
(2, 'Đồng hồ Nam SDJ00002W0  ', 81, 430000, 'dong-ho-nam-mvw-ml061-01-2.jpg', 1000, 68, 'Mới 100% ', '12 Tháng ', 2, '<p>Đồng hồ Orient đem đến những sản phẩm ấn tượng chinh phục người nh&igrave;n một c&aacute;ch nhanh ch&oacute;ng. Đồng hồ Orient với những chất liệu cao cấp b&oacute;ng bẩy n&acirc;ng tầm đẳng cấp cho người sở hữu, ph&ugrave; hợp với doanh nh&acirc;n th&agrave;nh đạt, d&acirc;n văn ph&ograve;ng hay c&aacute;c gi&aacute;m đốc c&ocirc;ng ty. Phong c&aacute;ch thời thượng, sang trọng đầy sức thu h&uacute;t đến từ đồng hồ Orient chắc chắn sẽ khiến bạn lu&ocirc;n h&atilde;nh diện với những người xung quanh.</p>'),
(3, 'Đồng hồ Nam Q&Q S306J30', 81, 650000, 'q-q-s306j301y-nam-2-org.jpg', 1000, 67, 'Mới 100%', '12 Tháng', 5, '\r\nĐồng hồ Nữ ELIO EL085-02 elio-el085-02-nu-2.jpg - Mang nét thanh lịch, tinh tế, chiếc đồng hồ này đến từ hãng đồng hồ Elio chất lượng của Việt Nam - thương hiệu độc quyền của Thế Giới Di Động\r\n- Chiếc đồng hồ nữ này có bộ máy của Nhật Bản, cho độ bền cao, hoạt động ổn định và chính xác trong thời gian dài\r\n- Đồng hồ có kích thước mặt 21 x 22 mm, độ rộng dây 10 mm\r\n- Dây da tổng hợp êm ái, nhẹ nhàng, ôm sát cổ tay, khung viền hợp kim có độ bền cao, chống ăn mòn, bảo vệ tốt phần lõi bên trong\r\n- Chỉ số chống nước 3 ATM: Đồng hồ vẫn an toàn khi bạn đeo đi mưa, rửa tay, không mang khi tắm, bơi, lặn'),
(4, 'Đồng hồ Nam MVW ML0-01 ', 84, 670000, '\r\ndong-ho-nam-mvw-ml065-01-2.jpg ', 1000, 67, 'Mới 100%', '12 Tháng', 0, 'Sản phẩm đồng hồ mang thương hiệu MVW với nhiều mẫu mã năng động, trẻ trung nhưng không kém phần tinh tế và sang trọng, phù hợp với tất cả mọi người hoạt động ở nhiều lĩnh vực từ dân văn phòng đến doanh nhân.\r\n'),
(5, 'Đồng hồ trẻ em SL382-4 ', 81, 650000, 'smile-kid-sl382-4-tre-em-2.jpg', 1000, 67, 'Mới 100%', '12 Tháng', NULL, '  Năng động, tinh nghịch\r\nSản phẩm đồng hồ mang thương hiệu Smile Kid với nhiều mẫu mã năng động, trẻ trung nhưng không kém phần tinh tế và sang trọng, phù hợp với các em nhỏ.\r\n'),
(6, 'Đồng hồ trẻ em SL382-1 ', 81, 670000, 'smile-kid-sl382-1-tre-em2.jpg', 1000, 66, 'Mới 100% ', '12 Tháng ', 0, '<p>Năng động, tinh nghịch Sản phẩm đồng hồ mang thương hiệu Smile Kid với nhiều mẫu m&atilde; năng động, trẻ trung nhưng kh&ocirc;ng k&eacute;m phần tinh tế v&agrave; sang trọng, ph&ugrave; hợp với c&aacute;c em nhỏ.</p>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`MaDonHang`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MaKH`);

--
-- Indexes for table `loaisp`
--
ALTER TABLE `loaisp`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Indexes for table `nsx`
--
ALTER TABLE `nsx`
  ADD PRIMARY KEY (`MaNSX`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaDongHo`),
  ADD KEY `MaNSX` (`MaNSX`),
  ADD KEY `MaLoai` (`MaLoai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `MaDonHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `loaisp`
--
ALTER TABLE `loaisp`
  MODIFY `MaLoai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `nsx`
--
ALTER TABLE `nsx`
  MODIFY `MaNSX` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaDongHo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `constraint_MaNSX` FOREIGN KEY (`MaNSX`) REFERENCES `nsx` (`MaNSX`),
  ADD CONSTRAINT `constraint_Maloai` FOREIGN KEY (`MaLoai`) REFERENCES `loaisp` (`MaLoai`),
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MaNSX`) REFERENCES `nsx` (`MaNSX`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sanpham_ibfk_2` FOREIGN KEY (`MaLoai`) REFERENCES `loaisp` (`MaLoai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

<link rel="stylesheet" type="text/css" href="css/muahang.css" />
<?php
require_once "../ketnoi/ketnoi.php";
if (isset($_SESSION['tkc'])) {
    $kh = $_SESSION['tkc'];
    $sqlkh = "SELECT * FROM khachhang WHERE TaiKhoan='$kh'";
    $querykh = mysqli_query($conn, $sqlkh);
    $rowkh = mysqli_fetch_array($querykh);
    $makh = $rowkh['MaKH'];

    // xử lý phần giỏ hàng
    if (isset($_SESSION['giohang'])) {
        $arrId = array();
        foreach ($_SESSION['giohang'] as $MaDongHo => $sl) {
            $arrId[] = $MaDongHo;
        }

        //Tách mảng arrId thành 1 chuỗi và ngăn cách bởi dấu ,
        $strID = implode(',', $arrId);

        $sql = "SELECT * FROM sanpham WHERE MaDongHo IN ($strID) order by MaDongHo desc";
        $query = mysqli_query($conn, $sql);
        
        //Xử lý phần mua hàng
        if (isset($_POST['submit'])) {
            while($rowdh=mysqli_fetch_array($query)){
                $madonghodh=$rowdh['MaDongHo'];
                $ngaydathang = date("Y-m-d H:i:s");
                $sldh=$_SESSION['giohang'][$rowdh['MaDongHo']];
                $Tongtiendh = $_SESSION['giohang'][$rowdh['MaDongHo']] * $rowdh['GiaBan'];
                //số lượng tồn
                $soluongton=$rowdh['SoLuong'];
                if ($soluongton <= 0) {
                    echo '<script>
                            alert("Số lượng sản phẩm trong kho đã hết!");
                            window.location.href="index.php";
                          </script>';
                } else if ($soluongton < $sldh) {
                    echo '<script>
                            alert("Số lượng sản phẩm trong kho không đủ!");
                            window.location.href="index.php";
                          </script>';
                } else {
                    // Thêm dữ liệu vào bảng đơn hàng
                    $sql_insert = "INSERT INTO donhang (MaDongHo, MaKH, NgayDat, SoLuong, TongTien)
                                   VALUES ('$madonghodh', '$makh', '$ngaydathang', '$sldh', '$Tongtiendh')";

                    if (mysqli_query($conn, $sql_insert)) {
                        // Sửa số lượng tồn
                        $sql_edit = "UPDATE sanpham SET SoLuong = SoLuong - $sldh WHERE MaDongHo = '$madonghodh'";
                        if (mysqli_query($conn, $sql_edit)) {
                            unset($_SESSION['giohang']);
                            echo '<script>alert("Qúy khách đã đặt hàng thành công, đơn vị vận chuyển sẽ giao đến cho quý khách trong thời gian sớm nhất");
                                window.location.href="index.php";
                                </script>';
                        }
                    } else {
                        echo '<script>alert("Lỗi khi thêm đơn hàng:");
                        window.location.href="index.php";
                        </script>' . mysqli_error($conn);
                    }
                }
            }
        }

          //Hiển thị danh sách sản phẩm
          $Tongtiensanpham = 0;
          $count=0;
        while ($row = mysqli_fetch_array($query)) {
            $Tongtien = $_SESSION['giohang'][$row['MaDongHo']] * $row['GiaBan'];

?>
            <div class="prd-block">
                <?php if($count==0){
                    echo '<h2>xác nhận hóa đơn thanh toán</h2>'
                        .'<div class="payment">
                        <table border="0px" cellpadding="0px" cellspacing="0px" width="100%">
                        <tr id="invoice-bar">
                            <td width="45%">Tên Sản phẩm</td>
                            <td width="20%">Giá</td>
                            <td width="15%">Số lượng</td>
                            <td width="20%">Thành tiền</td>
                        </tr>';
                    } $count+=1; ?>
                        <tr>
                            <td class="prd-name"><?php echo $row['TenDongHo'] ?></td>
                            <td class="prd-price"><?php $format_number_1 = number_format($row['GiaBan']);
                                                    echo $format_number_1 ?> VNĐ</td>
                            <td class="prd-number"><?php echo $dat=$_SESSION['giohang'][$row['MaDongHo']] ?></td>
                            <td class="prd-total"><?php $format_number_1 = number_format($Tongtien);
                                                    echo $format_number_1 ?> VNĐ</td>
                        </tr>
                <?php
                $Tongtiensanpham += $Tongtien;
            }
        }
                ?>
                <tr>
                    <td class="prd-name">Tổng giá trị hóa đơn là:</td>
                    <td colspan="2"></td>
                    <td class="prd-total"><span><?php $format_number_1 = number_format($Tongtiensanpham);
                                                echo $format_number_1 ?> VNĐ</span></td>
                </tr>
                    </table>
                </div>
                <div class="form-payment">
                    <form method="post">
                        <h2>Thông Tin của bạn</h2>
                        <ul>
                            <li class="info-cus"><label>Tên khách hàng</label><br /><input readonly type="text" name="ten" value="<?php echo $rowkh['TenKH']; ?>" /></li>
                            <li class="info-cus"><label>Địa chỉ Email</label><br /><input readonly type="text" name="mail" value="<?php echo $rowkh['Email']; ?>" /></li>
                            <li class="info-cus"><label>Số Điện thoại</label><br /><input readonly type="text" name="dt" value="<?php echo $rowkh['SDT']; ?>" /></li>
                            <li class="info-cus"><label>Địa chỉ nhận hàng</label><br /><input readonly type="text" name="dc" value="<?php echo $rowkh['DiaChi']; ?>" /></li>
                            <li><input class="btn btn-success" type="submit" name="submit" value="Xác nhận mua hàng" /> <button class="btn btn-default"><a href="index.php?page_layout=giohang">Quay lại</a></button></li>
                        </ul>
                    </form>
                </div>
            </div>
        <?php
    } else {
        echo '<script>alert("Qúy khách vui lòng đăng nhập để sử dụng chức năng này");
    window.location.href="index.php?page_layout=dangnhap";
    </script>';
    }

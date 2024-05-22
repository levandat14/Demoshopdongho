<?php
require_once("../ketnoi/ketnoi.php");
?>
<link rel="stylesheet" type="text/css" href="css/giohang.css" />
<div class="prd-block">
    <h2>giỏ hàng của bạn</h2>
    <div class="cart">
        <?php
        if (isset($_SESSION['giohang'])) {
            if (isset($_POST['sl'])) {
                foreach ($_POST['sl'] as $MaDongHo => $sl) {
                    if ($sl == 0) {
                        unset($_SESSION['giohang'][$MaDongHo]);
                    } elseif ($sl > 0) {
                        $_SESSION['giohang'][$MaDongHo] = $sl;
                    }
                }
            }
            $arrId = array();
            //Lấy ra id sản phẩm từ mảng session
            foreach ($_SESSION['giohang'] as $MaDongHo => $sl) {
                $arrId[] = $MaDongHo;
            }
            //Tách mảng arrId thành 1 chuỗi và ngăn cách bởi dấu ,kết hợp phần tử tronh mảng thành 1 chuỗi gán lại cho strID

            $strID = implode(',', $arrId);

            $sql = "SELECT * FROM sanpham WHERE MaDongHo IN ($strID) order by MaDongHo desc";
            $query = mysqli_query($conn, $sql);


        ?>
            <form method="post" id="giohang">
                <?php
                $tongtiengiohang = 0;
                while ($row = mysqli_fetch_array($query)) {
                    $tongtiensanpham = $row['GiaBan'] * $_SESSION['giohang'][$row['MaDongHo']];
                ?>
                    <table width="100%">
                        <tr>
                            <td class="cart-item-img" width="25%" rowspan="4"><a href="index.php?page_layout=Chitietsp&MaDongHo=<?php echo $row['MaDongHo'] ?>"><img width="80" height="144" src='../img/<?php echo $row['HinhAnh']; ?>'     /></a></td>
                            <td width="25%">Sản phẩm:</td>
                            <td class="cart-item-title" width="50%"> <?php echo $row['TenDongHo'] ?></a></td>
                        </tr>
                        <tr>
                            <td>Giá:</td>
                            <td><span><?php $format_number_1 = number_format($row['GiaBan']);
                                        echo $format_number_1 ?> VNĐ</span></td>
                        </tr>
                        <tr>
                            <!--theo dạng mảng mang-->
                            <td>Số lượng:</td>
                            <td><input type="number" class="txtsl" name="sl[<?php echo $row['MaDongHo'] ?>]" value="<?php echo $_SESSION['giohang'][$row['MaDongHo']] ?>" /></td>
                        </tr>
                        <tr>
                            <td>Tổng tiền:</td>
                            <td><span><?php $format_number_1 = number_format($tongtiensanpham);
                                        echo $format_number_1 ?> VNĐ</span></td>
                        </tr>
                        <tr>

                            <td><button class="btn btn-danger"><a style="color: white;" href="ChucNang_GioHang/xoahang.php?MaDongHo=<?php echo $row['MaDongHo'] ?>">Xóa</a></button></td>
                        </tr>

                    <?php
                    $tongtiengiohang += $tongtiensanpham;
                }
                    ?>
                    </table>
            </form>

            <p>Tổng giá trị giỏ hàng là: <span><?php $format_number_1 = number_format($tongtiengiohang);
                                                echo $format_number_1 ?> VNĐ</span></p>

            <tr>
                <td>
                    <button onclick="document.getElementById('giohang').submit();" href="#" class="btn btn-info">cập nhật giỏ hàng</button>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="ChucNang_GioHang/xoahang.php?MaDongHo=0" class="btn btn-default">xóa tất cả giỏ hàng</a>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-success"><a style="color:black" href="./index.php?page_layout=muahang">Mua Hàng</a></button>
                </td>
            </tr>
        <?php

        } else {
            echo '<script>alert("Giỏ Hàng Rỗng!!");
            window.location.href="index.php";
            </script>';
        }


        ?>
    </div>

</div>
<script>
    $(".txtsl").on("input", function() {
        var sl = $(this).val();
        $.ajax({
               url:"ChucNang_GioHang/Xulygiohang.php",
               method:"POST",
               data:{sl:sl},
               success:function(data){
                   $("#prds").html(data);
               }
           }
           )
    });
</script>

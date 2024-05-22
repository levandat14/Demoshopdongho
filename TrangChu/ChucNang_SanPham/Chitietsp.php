<link rel="stylesheet" type="text/css" href="css/chitietsp.css" />
<div class="prd-block">
    <div class="prd-only"> 
        <?php
        require_once("../ketnoi/ketnoi.php");
        $MaDongHo = $_GET['MaDongHo'];
        $sql = "SELECT * FROM sanpham WHERE MaDongHo = $MaDongHo";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        ?>
        <div class="prd-img"><img width="50%" src='../img/<?php echo $row['HinhAnh']; ?>'  /></div>
        <div class="prd-intro">
            <h3><?php echo $row['TenDongHo'] ?></h3>
            <p>Giá sản phẩm: <span><?php $format_number_1 = number_format($row['GiaBan']);
                                    echo $format_number_1 ?> VNĐ</span></p>
            <table>
                <tr>
                    <td width="30%"><span>Bảo hành:</span></td>
                    <td><?php echo $row['BaoHanh'] ?></td>
                </tr>

                <tr>
                    <td><span>Tình trạng:</span></td>
                    <td><?php echo $row['TinhTrang'] ?></td>
                </tr>
                <tr>
                    <td><span>Khuyến Mại:</span></td>
                    <td><?php
                        switch ($row['KhuyenMai']) {
                            case $row['KhuyenMai'] = 0:
                                echo "Sản Phẩm Hiện Không Có Khuyến Mãi!";
                                break;
                            case $row['KhuyenMai'] = 1:
                                echo "10%";
                                break;
                            case $row['KhuyenMai'] = 2:
                                echo "20%";
                                break;
                            case $row['KhuyenMai'] = 3:
                                echo "30%";
                                break;
                            case $row['KhuyenMai'] = 4:
                                echo "40%";
                                break;
                            case $row['KhuyenMai'] = 5:
                                echo "50%";
                                break;
                            default:
                                echo 'Sản Phẩm Hiện Không Có Khuyến Mãi!';
                                break;
                        }
                        ?></td>
                </tr>
                <tr>
                    <td><span>Trạng Thái:</span></td>
                    <td><?php
                        if ($row['SoLuong'] != 0) {
                            echo "Còn Hàng";
                        } else {
                            echo "Hết hàng";
                        }

                        ?></td>
                </tr>
            </table>
            <?php
            if ($row['SoLuong'] != 0) {
            ?>
                <p class="add-cart"><a href="ChucNang_GioHang/Themhang.php?MaDongHo=<?php echo $row['MaDongHo'] ?>"><button class="btn btn-danger">ĐẶT MUA</button></a></p>

            <?php
            } else {
                echo "<button >HẾT HÀNG</button>";
            }
            ?>

        </div>
    </div>
</div>
<div class="clear"></div>

<div class="prd-details">
    <p>
    <div class="prd-img"><img width="50%" src='../img/<?php echo $row['HinhAnh']; ?>'  /></div>
    </p>
</div>


<div class="prd-comment">
    <h3>Thông Tin Sản Phẩm</h3>
    <?php
    echo $row['MoTa'];
    ?>
</div>

<?php
$mnsx = $row['MaNSX'];
$sqlnsx = "SELECT * FROM sanpham WHERE MaNSX=$mnsx AND MaDongHo != $MaDongHo  limit 3  ";
$querynsx = mysqli_query($conn, $sqlnsx);
?>
<div class="prd-block">
    <h2>Sản Phẩm Tương Tự</h2>
    <div class="pr-list">
        <?php

        while ($row = mysqli_fetch_array($querynsx)) {
        ?>
            <div class="prd-item">
                <a href="index.php?page_layout=Chitietsp&MaDongHo=<?php echo $row['MaDongHo'] ?>"> <img src='../img/<?php echo $row['HinhAnh']; ?>'  class="img-responsive" style="width: 100%" alt="Image"></a>
                <h3><a href="#"><?php echo $row['TenDongHo'] ?></a></h3>

                <p class="price"><span>Giá: <?php $format_number_1 = number_format($row['GiaBan']);
                                            echo $format_number_1 ?> VNĐ</span></p>
            </div>
        <?php
        }
        ?>
        <div class="clear"></div>
    </div>
</div>

<?php
require_once __DIR__ . '/../../ketnoi/ketnoi.php';
$sql = "SELECT * FROM sanpham WHERE MaNSX=81 limit 3  ";
$query = mysqli_query($conn, $sql);
?>
<div class="prd-block">
    <h2>G-SHOCK</h2>
    <div class="pr-list">
        <?php

        while ($row = mysqli_fetch_array($query)) {
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
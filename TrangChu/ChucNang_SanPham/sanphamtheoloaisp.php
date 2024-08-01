<?php
require_once __DIR__ . '/../../ketnoi/ketnoi.php';
$MaLoai = $_GET['MaLoai'];
$sql = "SELECT * FROM sanpham WHERE MaLoai = $MaLoai ";
$query = mysqli_query($conn, $sql);

?>
<?php

$MaLoai = $_GET['MaLoai'];
$sqlloaisp = "SELECT * FROM loaisp WHERE MaLoai = $MaLoai";
$queryloaisp = mysqli_query($conn, $sqlloaisp);
$rowloaisp = mysqli_fetch_array($queryloaisp);
?>

<div class="prd-block">
    <h2>
        <?php
        echo $rowloaisp['TenLoai'];
        ?>

    </h2>
    <div class="pr-list">

        <?php

        while ($row = mysqli_fetch_array($query)) {
        ?>

            <div class="prd-item">
                <a href="index.php?page_layout=Chitietsp&MaDongHo=<?php echo $row['MaDongHo'] ?>"> <img src='../img/<?php echo $row['HinhAnh']; ?>' class="img-responsive" style="width: 100%" alt="Image"></a>
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
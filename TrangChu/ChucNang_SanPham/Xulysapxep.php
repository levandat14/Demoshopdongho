<script src="../ajax/jquery-3.6.0.min.js"></script>
<?php
require_once("../ketnoi/ketnoi.php");

if (isset($_POST['sapxep'])) {
    $sapxep = $_POST['sapxep'];
    $MaNSX = $_POST['MaNSX'];
    $loaddulieu = '';
    switch ($sapxep) {
        case '1':
            $sql = "SELECT * FROM sanpham WHERE MaNSX = '$MaNSX' ORDER BY GiaBan DESC";
            $query = mysqli_query($conn, $sql);
?>
            <div class="pr-list">

                <?php
                $loaddulieu = '';
                while ($row = mysqli_fetch_array($query)) {
                    $loaddulieu .= '<div class="prd-item">
                <a href="index.php?page_layout=Chitietsp&MaDongHo=' . $row['MaDongHo'] . '"> <img src="../img/' . $row['HinhAnh'] . '" class="img-responsive" style="width: 100%" alt="Image"></a>
                <h3><a href="#">' . $row['TenDongHo'] . '</a></h3>
    
                <p class="price"><span>Giá: ' . number_format($row['GiaBan']) . ' VNĐ</span></p>
            </div>';
                }
                break;
            case '2':
                $sql = "SELECT * FROM sanpham WHERE MaNSX = '$MaNSX' ORDER BY GiaBan ASC";
                $query = mysqli_query($conn, $sql);
                ?>
                <div class="pr-list">

                    <?php
                    $loaddulieu = '';
                    while ($row = mysqli_fetch_array($query)) {
                        $loaddulieu .= '<div class="prd-item">
                <a href="index.php?page_layout=Chitietsp&MaDongHo=' . $row['MaDongHo'] . '"> <img src="../img/' . $row['HinhAnh'] . '" class="img-responsive" style="width: 100%" alt="Image"></a>
                <h3><a href="#">' . $row['TenDongHo'] . '</a></h3>

                <p class="price"><span>Giá: ' . number_format($row['GiaBan']) . ' VNĐ</span></p>
            </div>';
                    }
                    break;
                default:
                    $sql = "SELECT * FROM sanpham WHERE MaNSX = '$MaNSX' ORDER BY GiaBan ASC";
                    $query = mysqli_query($conn, $sql);
                    ?>
                    <div class="pr-list">

            <?php
                    $loaddulieu = '';
                    while ($row = mysqli_fetch_array($query)) {
                        $loaddulieu .= '<div class="prd-item">
            <a href="index.php?page_layout=Chitietsp&MaDongHo=' . $row['MaDongHo'] . '"> <img src="../img/' . $row['HinhAnh'] . '" class="img-responsive" style="width: 100%" alt="Image"></a>
            <h3><a href="#">' . $row['TenDongHo'] . '</a></h3>

            <p class="price"><span>Giá: ' . number_format($row['GiaBan']) . ' VNĐ</span></p>
        </div>';
                    }
            }
        }
        echo $loaddulieu;
            ?>
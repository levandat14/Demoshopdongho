<script src="../ajax/jquery-3.6.0.min.js"></script>
<?php
require_once __DIR__ . '/../../ketnoi/ketnoi.php';
$MaNSX = $_GET['MaNSX'];
$sql = "SELECT * FROM sanpham WHERE MaNSX = $MaNSX ";
$query = mysqli_query($conn, $sql);

?>
<?php
$MaNSX = $_GET['MaNSX'];
$sqlnsx = "SELECT * FROM nsx  WHERE MaNSX = $MaNSX ";
$querynsx = mysqli_query($conn, $sqlnsx);
$rownsx = mysqli_fetch_array($querynsx);
?>

<div class="prd-block">
    <h2>

        <form method="post">
            <div class="lesapxep">
                <?php
                echo $rownsx['TenNSX'];
                ?>
                <select class="lesapxepp" id="sapxep" name="sapxep">
                    <option value="0" selected>---Lọc---</option>
                    <option value="1">Gía Cao Tới Thấp</option>
                    <option value="2">Gía Thấp Tới Cao</option>
                </select>

            </div>
        </form>
    </h2>

    <div class="result"></div>

    <?php
$MaNSX = $_GET['MaNSX'];
$sql = "SELECT * FROM sanpham WHERE MaNSX = '$MaNSX' ORDER BY MaDongHo ASC";
$query = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($query)) {
    echo '<div class="prd-item">';
    echo '<a href="index.php?page_layout=Chitietsp&MaDongHo=' . $row['MaDongHo'] . '">';
    echo '<img src="../img/' . $row['HinhAnh'] . '" class="img-responsive" style="width: 100%" alt="Image"></a>';
    echo '<h3><a href="#">' . $row['TenDongHo'] . '</a></h3>';
    echo '<p class="price"><span>Giá: ' . number_format($row['GiaBan']) . ' VNĐ</span></p>';
    echo '</div>';
}
?>

<script>
    $("#sapxep").ready(function() {
        $(".lesapxepp").change(function() {
            $(".prd-item").hide();
            var sapxep = $(this).val(); 
            var MaNSX = "<?php echo $_GET['MaNSX']; ?>"; 
                load_dulieu(sapxep, MaNSX); 
            });

            function load_dulieu(sapxep, MaNSX) {
                $.ajax({
                    url: "ChucNang_SanPham/xulysapxep.php",
                    method: "POST",
                    data: {
                        sapxep: sapxep,
                        MaNSX: MaNSX
                    },
                    success: function(data) {
                        $(".result").html(data); 
                    }
                });
            }
        });
    </script>
</div>
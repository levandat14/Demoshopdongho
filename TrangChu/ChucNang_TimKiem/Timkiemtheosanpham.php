<?php
  require_once("../ketnoi/ketnoi.php");
if (isset($_GET['timkiem'])) {
    function convert_vi_to_en($str) {
        $str = preg_replace("/(á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ặ|ẵ|â|ấ|ầ|ẩ|ậ|ẫ)/", "a", $str);
        $str = preg_replace("/(é|è|ẻ|ẹ|ẽ|ê|ế|ề|ể|ệ|ễ)/", "e", $str);
        $str = preg_replace("/(i|í|ì|ỉ|ị|ĩ)/", "i", $str);
        $str = preg_replace("/(ó|ò|ỏ|ọ|õ|ô|ố|ồ|ổ|ộ|ỗ|ơ|ớ|ờ|ở|ợ|ỡ)/", "o", $str);
        $str = preg_replace("/(ú|ù|ủ|ụ|ũ|ư|ứ|ừ|ử|ự|ữ)/", "u", $str);
        $str = preg_replace("/(ý|ỳ|ỷ|ỵ|ỹ)/", "y", $str);
        $str = preg_replace("/(đ)/", "d", $str);
        $str = preg_replace("/( )/", "", $str); // Loại bỏ khoảng cách
        return $str;
    }
    $timkiem = $_GET['timkiem'];
    $timkiem=convert_vi_to_en($timkiem);
    $sql = "SELECT * FROM sanpham WHERE 
    LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(TenDongHo, 'á', 'a'), 'à', 'a'), 'ả', 'a'), 'ạ', 'a'), 'ã', 'a'), 'ă', 'a'), 'ắ', 'a'), 'ằ', 'a'), 'ẳ', 'a'), 'ặ', 'a'), 'ẵ', 'a')) LIKE '%$timkiem%' 
    OR LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(BaoHanh, 'é', 'e'), 'è', 'e'), 'ẻ', 'e'), 'ẹ', 'e'), 'ẽ', 'e'), 'ê', 'e'), 'ế', 'e'), 'ề', 'e'), 'ể', 'e'), 'ệ', 'e'), 'ễ', 'e')) LIKE '%$timkiem%'";
    $query = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($query);
    if ($num > 0) {
?>
        <div class="prd-block">
            <h2>Sản Phẩm Bạn Đang Tìm</h2>
            <div class="pr-list">
                <?php
                while ($row = mysqli_fetch_array($query)) {
                ?>
                    <div class="prd-item">
                        <a href="index.php?page_layout=Chitietsp&MaDongHo=<?php echo $row['MaDongHo'] ?>"> <img src='../img/<?php echo $row['HinhAnh']; ?>' class="img-responsive" style="width: 100%" alt="Image"></a>
                        <h3><a href="#"><?php echo $row['TenDongHo'] ?></a></h3>
                        <p>Được Giảm: <?php switch ($row['KhuyenMai']) {
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
                                        } ?></p>
                        <p class="price"><span>Giá: <?php $format_number_1 = number_format($row['GiaBan']);
                                                    echo $format_number_1 ?> VNĐ</span></p>
                    </div>
        <?php
                }
            }else{
                echo '<h4>không tồn tại sản phẩm </h4>';  
           }
        }
        ?>
            </div>
        </div>
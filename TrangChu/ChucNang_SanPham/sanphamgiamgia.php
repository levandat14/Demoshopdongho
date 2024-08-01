<?php
    require_once __DIR__ . '/../../ketnoi/ketnoi.php';
  $sql = "SELECT * FROM sanpham WHERE KhuyenMai !=0 ";
    $query = mysqli_query($conn, $sql);
?>
<div class="prd-block">
    <h2>Sản Phẩm Đang Giam Gía</h2>
    <div class="pr-list">
       
    <?php
        while($row=mysqli_fetch_array($query)){
    ?>
        <div class="prd-item">
       <a href="index.php?page_layout=Chitietsp&MaDongHo=<?php echo $row['MaDongHo'] ?>">  <img src='../img/<?php echo $row['HinhAnh']; ?>'  class="img-responsive" style="width: 100%" alt="Image"></a>
            <h3><a href="#"><?php echo $row['TenDongHo'] ?></a></h3>
            <p>Được Giảm: <?php   switch($row['KhuyenMai']){
                        case $row['KhuyenMai'] =0: echo "Sản Phẩm Hiện Không Có Khuyến Mãi!";break;
                        case $row['KhuyenMai'] =1: echo "10%";break;
                        case $row['KhuyenMai'] =2: echo "20%";break;
                        case $row['KhuyenMai'] =3: echo "30%";break;
                        case $row['KhuyenMai'] =4: echo "40%";break;
                        case $row['KhuyenMai'] =5: echo "50%";break;
                        default:
                          echo 'Sản Phẩm Hiện Không Có Khuyến Mãi!'; break;
       
                    } ?></p>
            <p class="price"><span>Giá: <?php $format_number_1 = number_format($row['GiaBan']); echo $format_number_1 ?> VNĐ</span></p>
        </div>
    <?php
        
        }
    ?>
        <div class="clear"></div>
    </div>
</div>
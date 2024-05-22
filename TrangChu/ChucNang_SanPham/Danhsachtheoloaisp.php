<div class="l-sidebar">
	<ul id="main-menu">
    <h2>Loại sản phẩm</h2>
    <?php
     require_once("../ketnoi/ketnoi.php");
        $sql = "SELECT * FROM loaisp";
        $query = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($query)){
    ?>
   
    	<li><a href="index.php?page_layout=sanphamtheoloaisp&MaLoai=<?php echo $row['MaLoai']?>"> <?php echo $row['TenLoai'] ?></a></li>
    <?php
        }
    ?>
    </ul>
</div>
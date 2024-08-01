<div class="l-sidebar">
	<ul id="main-menu">
    <h2>Nhà sản xuất</h2>
    <?php
     require_once __DIR__ . '/../../ketnoi/ketnoi.php';
        $sql = "SELECT * FROM nsx";
        $query = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($query)){
    ?>
   
    	<li><a href="index.php?page_layout=sanphamtheonsx&MaNSX=<?php echo $row['MaNSX']?>"> <?php echo $row['TenNSX'] ?></a></li>
    <?php
        }
    ?>
    </ul>
</div>
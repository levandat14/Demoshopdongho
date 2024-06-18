<div class="l-sidebar">
	<h2>thống kê truy cập</h2>
    <div id="counter">
    <?php
    	$fp='/app/TrangChu/ChucNang_ThongKe/dem.txt';
		$fo=fopen($fp, 'r');
		$fr=fread($fo, filesize($fp));
		$fr++;
		$fc=fclose($fo);
		$fo=fopen($fp, 'w');
		$fw=fwrite($fo, $fr);
		$fc=fclose($fo);
    ?>
    	<p>Hiện có <span><?php
    	echo $fr;
    	?></span> người đang xem</p>
    </div>
</div>
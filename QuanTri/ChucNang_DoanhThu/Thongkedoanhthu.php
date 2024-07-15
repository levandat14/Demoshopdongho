<?php
if ($_SESSION['tk']) {
    require_once('../ketnoi/ketnoi.php');
?>
    <link rel="stylesheet" type="text/css" href="css/danhsachsp.css" />
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Doanh thu</title>
    </head>

    <body>
        <div id="revenue-form">
            <form action="#" method="post">
                <label for="start_date">Ngày bắt đầu:</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : "";  ?>" required>
                <label for="end_date">Ngày kết thúc:</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : "";  ?>" required>
                <button type="submit">Xem doanh thu</button>
            </form>
        </div>
        <div id="revenue-results">
            <?php
            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $sql = "SELECT s.TenDongHo,  s.HinhAnh, s.GiaBan, SUM(d.SoLuong) AS SoLuong, SUM(d.TongTien) AS TongTien 
                FROM donhang d
                JOIN sanpham s ON d.MaDongHo = s.MaDongHo 
                WHERE date(d.NgayDat) BETWEEN '$start_date' AND '$end_date'
                GROUP BY d.MaDongHo
                ORDER BY SoLuong DESC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
            ?>
                    <div id="main">
                        <table id="prds" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr id="prd-bar">
                                <td>ID</td>
                                <td>Tên Đồng Hồ</td>
                                <td>Hình Đồng Hồ</td>
                                <td>Gía bán</td>
                                <td>Số lượng</td>
                                <td>Tổng tiền</td>
                            </tr>

                            <?php
                            $tongdoanhthu = 0;
                            $stt = 0;
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td class="l5"><?php echo $stt ?></td>
                                    <td class="l5"><?php echo $row['TenDongHo'] ?></td>
                                    <td><span class="thumb"><img width="60" src="../img/<?php echo $row['HinhAnh']; ?>" /></span></td>
                                    <td class="l5"><?php echo number_format($row['GiaBan']) ?></td>
                                    <td class="l5"><?php echo $row['SoLuong'] ?></td>
                                    <td class="l5"><?php echo number_format($row['TongTien']) ?></td>
                                </tr>
                    <?php
                                $tongdoanhthu += $row["TongTien"];
                                $stt += 1;
                            }
                            echo "</table>";
                            echo "</div>";
                            echo "<p><strong>Tổng doanh thu: </strong><strong style='color: red;'>" . number_format($tongdoanhthu) . " VND</strong></p>";
                        } else {
                            echo "Không có đơn hàng nào trong khoảng thời gian này.";
                        }
                    }

                    ?>
                    </div>
    </body>

    </html>
<?php
} else {
    header('location: ../quantri.php');
}
?>
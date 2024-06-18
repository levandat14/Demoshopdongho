
<?php
session_start();
//insert du lieu
require_once("../ketnoi/ketnoi.php");
if($_SESSION['tk']){
if (isset($_POST['themloaisp'])) {
    $insertdulieu = $_POST['themloaisp'];
    //sql kiem tra
    $check_sql = "SELECT * FROM loaisp WHERE TenLoai = '$insertdulieu'";
    $check_query = mysqli_query($conn, $check_sql);
    //kt có dữ liệu không
    if (mysqli_num_rows($check_query) > 0) {
        $erro =  "Dữ liệu đã tồn tại";
        echo $erro;
        exit();
    } else {
        $sql = "INSERT INTO loaisp(TenLoai) VALUES ('$insertdulieu') ";
        $query = mysqli_query($conn, $sql);
    }
}
// edit du lieu
if (isset($_POST['idloaisp'])) {
    $idloaisp = $_POST['idloaisp'];
    $text = $_POST['text'];
    //sql kiem tra
    $check_sql = "SELECT * FROM loaisp WHERE TenLoai = '$text'";
    $check_query = mysqli_query($conn, $check_sql);
    //kt có dữ liệu không
    if (mysqli_num_rows($check_query) > 0) {
        $erro =  "Dữ liệu đã tồn tại";
        echo $erro;
        exit();
    } else {
        $sql = "UPDATE loaisp SET TenLoai='$text' where MaLoai='$idloaisp'";
        $query = mysqli_query($conn, $sql);
    }
}
//delete du lieu
if (isset($_POST['maloaisp'])) {
    $maloaisp = $_POST['maloaisp'];
    $sqlsp = "SELECT * FROM sanpham WHERE MaLoai='$maloaisp'";
    $querysp = mysqli_query($conn, $sqlsp);
    $rowsp = mysqli_fetch_array($querysp);
    if ($rowsp > 0) {
        $erro = "Không thể xóa loại sản phẩm này vì đang tồn tại sản phẩm với mã loại " . $rowsp['MaLoai'];
        echo $erro;
        exit();
    } else {
        $sql = "DELETE FROM loaisp where MaLoai='$maloaisp'";
        $query = mysqli_query($conn, $sql);
    }
}
// //load du lieu
$loaddulieu = '';

$sql = "SELECT * FROM loaisp ORDER BY MaLoai DESC";
$query = mysqli_query($conn, $sql);

$loaddulieu .= '
    <table id="prds" border="20" cellpadding="0" cellspacing="5" width="70%">
    <tr id="prd-bar">
        <td width="10%">Mã Loai SP</td>
        <td width="80%">Tên Loai San Pham</td>
       
        <td width="10%">Quan Ly</td>
      
    </tr>
        
    ';
if ($num = mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {

        $loaddulieu .= '
            <tr id="fromloaisp">
            <td >' . $row['MaLoai'] . '</td>
            <td contenteditable data-id=' . $row['MaLoai'] . ' class="l5 tenloaisp"><h3>' . $row['TenLoai'] . '</h3></td>
            <td><span><input type="submit"class="btnxoa" data-id=' . $row['MaLoai'] . ' value="Xóa"></input></span></td>
        </tr>  
            ';
    }
} else {
    echo 'khong co du lieu';
}
$loaddulieu .= '</table>';
echo $loaddulieu;

}else {
    header('location: ../quantri.php');
}
?>
<link rel="stylesheet" type="text/css" href="css/danhsachsp.css" />

<?php   
    require_once("../ketnoi/ketnoi.php");
    //delete du lieu
    if(isset($_POST['idtaikhoan'])){
        $idtaikhoan=$_POST['idtaikhoan'];
        $sql="DELETE FROM admin WHERE ID='$idtaikhoan'";
        $query=mysqli_query($conn,$sql);
    }
$loaddulieu='
<table id="prds" border="20" cellpadding="0" cellspacing="5" width="70%">
<tr id="prd-bar">
    <td width="10%">STT</td>
    <td width="70%">Tên Tài Khoản</td>
    <td width="20%">Phân Quyền</td>
  
</tr>';

$sql = "SELECT * FROM admin ORDER BY ID DESC";
$query = mysqli_query($conn, $sql);
$number=1;
while ($row = mysqli_fetch_array($query)) {
    $loaddulieu.=' 
        <tr id="fromloaisp">
            <td><span>'.$number.'</span></td>
            <td  data-id='.$row['ID'].' class="l5 tenloaisp"><h3>'.$row['TenDangNhap'].'</h3></td>';

        if ($row['LoaiTK'] != 1) {
            $loaddulieu .= '<td><span><input type="submit" class="btnxoa" data-id='.$row['ID'].' value="Xóa"></input></span></td>';
        } else {
            $loaddulieu .= '<td></td>'; 
        }

$loaddulieu .= '</tr>';
            $number+=1;
}
$loaddulieu .='</table>';
echo $loaddulieu;

?>

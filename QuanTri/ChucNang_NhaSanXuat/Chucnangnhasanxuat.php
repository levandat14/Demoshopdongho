
<?php
session_start();
if($_SESSION['tk']){
    //insert du lieu
    require_once("../ketnoi/ketnoi.php");
    if(isset($_POST['insert'])){
    $insertdulieu=$_POST['insert'];
    //sql kiem tra
    $check_sql = "SELECT * FROM nsx WHERE TenNSX = '$insertdulieu'";
    $check_query = mysqli_query($conn, $check_sql);
    //kt có dữ liệu không
    if (mysqli_num_rows($check_query) > 0) {
        $erro =  "Dữ liệu đã tồn tại";
        echo $erro;
        exit();
    }else{
    //them du lieu
        $sql="INSERT INTO nsx(TenNSX) VALUES ('$insertdulieu') ";
        $query=mysqli_query($conn, $sql);
        }
    }

    //edit du lieu
    if(isset($_POST['idnsx'])){
        $idnsx=$_POST['idnsx'];
        $text=$_POST['text'];
        //kt có dữ liệu không
        $check_sql = "SELECT * FROM nsx WHERE TenNSX = '$text'";
        $check_query = mysqli_query($conn, $check_sql);
        if (mysqli_num_rows($check_query) > 0) {
            $erro =  "Dữ liệu đã tồn tại";
            echo $erro;
            exit();
        }else{
            $sql="UPDATE nsx SET TenNSX='$text' where MaNSX='$idnsx'";
            $query=mysqli_query($conn,$sql);
        }
    }

    //delete du lieu
    if(isset($_POST['mansx'])){
        $mansx=$_POST['mansx'];
        $sqlsp="SELECT * FROM sanpham WHERE MaNSX='$mansx'";
        $querysp=mysqli_query($conn,$sqlsp);
        $rowsp=mysqli_fetch_array($querysp);
        if($rowsp > 0) {
            $erro = "Không thể xóa nhà sản xuất này vì đang tồn tại sản phẩm với mã nhà sản xuất " . $rowsp['MaNSX'];
            echo $erro;
            exit();
        } else {
            $sql="DELETE FROM nsx WHERE MaNSX='$mansx'";
            $query=mysqli_query($conn,$sql);
        }
    }
    
    //load du lieu
    $loaddulieu ='';
   
        $sql="SELECT * FROM nsx ORDER BY MaNSX DESC";
        $query=mysqli_query($conn, $sql);

    $loaddulieu .='
    <table id="prds" border="20" cellpadding="0" cellspacing="5" width="70%">
    <tr id="prd-bar">
        <td width="10%">Mã NSX</td>
        <td width="80%">Tên Nhà Sản Xuất</td>
       
        <td width="10%">Quan Ly</td>
      
    </tr>
        
    ';
    if($num=mysqli_num_rows($query)>0){
        while($row=mysqli_fetch_array($query)){

            $loaddulieu .='
            <tr id="fromnsx">
            <td >'.$row['MaNSX'].'</td>
            <td contenteditable data-id='.$row['MaNSX'].' class="l5 tennsx"><h3>'.$row['TenNSX'].'</h3></td>
            <td><span><input type="submit"class="btnxoa" data-id='.$row['MaNSX'].' value="Xóa"></input></span></td>
        </tr>  
            ';
        }
    }else{
        echo 'khong co du lieu';
    }
    $loaddulieu .='</table>';
    echo $loaddulieu;
}else {
    header('location: ../quantri.php');
}
?>

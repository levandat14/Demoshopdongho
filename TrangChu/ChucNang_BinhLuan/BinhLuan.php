<?php

    include_once('../ketnoi/ketnoi.php');
    $MaDongHo=$_GET['MaDongHo'];
    $sqlbl="SELECT * FROM binhluan WHERE MaDongHo = $MaDongHo";
    $querybl = mysqli_query($conn, $sqlbl);
    $rowbl = mysqli_fetch_array($querybl);
    if(isset($rowbl['noidung_bl']) && $rowbl['XacNhanBL']==1){
        $Makh=$rowbl['MaKH'];
        $sqlkh="SELECT * FROM khachhang where MaKH=$Makh";
        $querykh=mysqli_query($conn,$sqlkh);
        $rowkh=mysqli_fetch_array($querykh);
        echo $rowkh['TenKH'];
        echo $rowbl['noidung_bl'];
    }



?>
<?php
    session_start();
    $MaDongHo=$_GET['MaDongHo'];

    if(isset($_SESSION['giohang'][$MaDongHo])){
        $_SESSION['giohang'][$MaDongHo]=$_SESSION['giohang'][$MaDongHo]+1;

    }
    else{
        $_SESSION['giohang'][$MaDongHo]=1;
    }

    header('location: ../index.php?page_layout=giohang');

?>
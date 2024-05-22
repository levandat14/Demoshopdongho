<?php
session_start();
if(isset($_SESSION['tk'])){
    session_destroy();
    header('location: Dangnhap.php');
}else{
    header('location: Dangnhap.php');
}

?>
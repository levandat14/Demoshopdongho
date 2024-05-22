<?php
    require_once("../ketnoi/ketnoi.php");
    if(isset($_SESSION['tkc'])){
        $tkc=$_SESSION['tkc'];
        $sql="SELECT * FROM khachhang WHERE TaiKhoan='$tkc'";
        $query=mysqli_query($conn, $sql);
        $row=mysqli_fetch_array($query);
            if(isset($_POST['btnsubmit'])){
                $matkhauhientai=$_POST['txtmatkhauhientai'];
                $matkhaimoi=$_POST['txtmatkhaumoi'];
                $xacnhanmatkhaumoi=$_POST['txtxacnhanmatkhaumoi'];
                if(md5($matkhauhientai)==$row['MatKhau']){
                    if($matkhaimoi==$xacnhanmatkhaumoi){
                        if(isset($matkhauhientai) && ($matkhaimoi) && ($xacnhanmatkhaumoi)){
                            $xacnhanmatkhaumoimahoa=md5($xacnhanmatkhaumoi);
                            $sql="UPDATE khachhang SET MatKhau='$xacnhanmatkhaumoimahoa' where TaiKhoan='$tkc' ";
                            $query=mysqli_query($conn,$sql);
                            echo '<script>alert("Qúy khách đã thay đổi mật khẩu thành công");
                            window.location.href="index.php?page_layout=thongtin";
                            </script>';
                        }
                    }else{
                        echo '<script>alert("Xác nhận mật khẩu không đúng!");
                        window.location.href="index.php?page_layout=doimatkhaukh";
                        </script>';
                    }
                }else{
                    echo '<script>alert("Mật khẩu hiện tại quý khách nhập không đúng!");
                        window.location.href="index.php?page_layout=doimatkhaukh";
                        </script>';
                }
            }

?>

<form method="post">
    <div class="prd-block">
        <h2>Xin chào: <?php echo $row['TenKH']; ?></h2>
    </div>
    <div id="form-login">
				<h2>Thông tin của bạn</h2>
				<ul>
					<li style="color: black;">Mật Khẩu Hiện Tại:<input required type="password" name="txtmatkhauhientai"  ?></li> 
					<li style="color: black;">Mật Khẩu Mới:<input required  type="password" name="txtmatkhaumoi"?></li>
                    <li style="color: black;">Nhập Lại Mật Khẩu Mới:<input required type="password" name="txtxacnhanmatkhaumoi" ?></li> 
					<li><input class="btn btn-success" type="submit" name="btnsubmit" value="Cập Nhập" /> <button class="btn"><a href="index.php?page_layout=thongtin">Quay Lại</a></button>
                    
				</ul>
               
	</div>
</form>
<?php
} else {
    echo '<script>alert("Qúy khách vui lòng đăng nhập để sử dụng chức năng này",  window.location.href = "index.php");</script>';


}
?>
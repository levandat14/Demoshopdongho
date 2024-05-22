<?php
 
include_once('../ketnoi/ketnoi.php');
    if(isset($_POST['btnsubmit'])){
        if(!isset($_SESSION['tkc'])){
        echo '<script>alert("Bạn cần đăng nhập để sử dụng chức năng này!");</script>';
        }
        else
        {
            $MaDongHo=$_GET['MaDongHo'];
           $sql="SELECT * from binhluan as bl

           Join khachhang as kh on bl.MaKH= kh.MaKH WHERE bl.MaDongHo=$MaDongHo";
           $query=mysqli_query($conn, $sql);
           $row=mysqli_fetch_array($query);
           echo $row['TenKH'];
        } 
    }
?>


<form method="post" >
<lable>Binh Luan Khach Hang</lable>
</div>
<div class="lbinput">
    <input type="textarea" required name="txtmota" class="form-control" cols="21" form-groups="18" value="<?php  ?> "></input>
    <input type="submit" name="btnsubmit" value="Binh Luan" />
</div>
</form>

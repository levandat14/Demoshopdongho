<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../ajax/jquery-3.6.0.min.js"></script>
</head>
<body>
<h2>quản lý tai khoản</h2>
    <div id="main">
    <p id="add-prd"><a href="quantri.php?page_layout=themtkadmin"><span style="color: black;">thêm tài khoản</span></a></p>
        <div id="truyenvao_taikhoanadmin"></div>
        </div>
</body>
<script>
        $(document).ready(function(){
        //     //load du lieu
            function load_dulieu_taikhoan(){
                $.ajax({
                    url:"ChucNang_TaikhoanAdmin/TaiKhoanAdmin.php",
                    method:"post",                  
                    success:function(data){
                    $('#truyenvao_taikhoanadmin').html(data);
                    }
                })
            }
            load_dulieu_taikhoan()
        //     //delete du lieu
            function delete_dulieu(idtaikhoan){
                $.ajax({
                    url:"ChucNang_TaikhoanAdmin/TaiKhoanAdmin.php",
                    method:"post", 
                    data:{idtaikhoan:idtaikhoan},                 
                    success:function(data){
                    alert('Xóa dữ liệu thành công');
                    load_dulieu_taikhoan()
                    }

                })
            }
            $(document).on('click','.btnxoa', function(){
                var idtaikhoan=$(this).data('id');
               delete_dulieu(idtaikhoan)
            })
        })

    </script>
</html>

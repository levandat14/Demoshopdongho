<?php if(isset($_SESSION['tk'])){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../ajax/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/danhsachsp.css" />
</head>
<body>
<h2>quản lý loai sản phẩm</h2>
    <div id="main">
    <form method="post">
                <input type="text" class="loai_sp" placeholder="Moi nhap..."/>
                <input type="submit" class="btnsubmit_loaisp" value="Them"/>
    </form>
    <div id="truyenvao_loaisp"></div>
    </div>
</body>
<script>
        $(document).ready(function(){
        //     //load du lieu
            function load_dulieu_loaisp(){
                $.ajax({
                    url:"ChucNang_LoaiSanPham/Chucnangloaisanpham.php",
                    method:"post",                  
                    success:function(data){
                    $('#truyenvao_loaisp').html(data);
                    }
                })
            }
            load_dulieu_loaisp()
            //edit du lieu
            function edit_dulieu(idloaisp, text){
                $.ajax({
                    url:"ChucNang_LoaiSanPham/Chucnangloaisanpham.php",
                    method:"post", 
                    data:{idloaisp:idloaisp,text:text},                 
                    success:function(data){
                        if(data.includes("Dữ liệu đã tồn tại")) {
                            alert(data);
                            load_dulieu();
                        } else {
                            alert('Edit dữ liệu thành công');
                            load_dulieu();
                        }
                    }
                })
            }
            $(document).on('focus', '.tenloaisp', function() {
                $(this).data('original', $(this).text());
            });
            $(document).on('blur','.tenloaisp', function(){
                var idnsx=$(this).data('id');
                var text=$(this).text();
                var original=$(this).data('original');
                if(text !==original){
                    edit_dulieu(idnsx,text)
                }
              
            })
        //     //delete du lieu
            function delete_dulieu(maloaisp){
                $.ajax({
                    url:"ChucNang_LoaiSanPham/Chucnangloaisanpham.php",
                    method:"post", 
                    data:{maloaisp:maloaisp},                 
                    success:function(data){
                        if(data.includes("Không thể xóa loại sản phẩm này vì đang tồn tại sản phẩm với mã loại")) {
                            alert(data);
                            load_dulieu_loaisp()
                        }else{
                            alert('Xóa dữ liệu thành công');
                            load_dulieu_loaisp()
                        }
                    
                    }

                })
            }
            $(document).on('click','.btnxoa', function(){
                var maloaisp=$(this).data('id');
               delete_dulieu(maloaisp)
            })
        //     //insert du lieu
            $(".btnsubmit_loaisp").on('click', function(){
                var themloaisp=$('.loai_sp').val();
                if(themloaisp!=''){
                $.ajax({
                    url:"ChucNang_LoaiSanPham/Chucnangloaisanpham.php",
                    method:"post",
                    data:{themloaisp:themloaisp},
                    success:function(data){
                        if(data.includes("Dữ liệu đã tồn tại")) {
                            alert(data);
                            load_dulieu();
                        } else {
                            alert('Thêm dữ liệu thành công');
                            load_dulieu();
                        }
                    }
                })
            }else{
                alert('Khong duoc de trong');
                
            }
            })
        })

    </script>
</html>
<?php
} else {
    header('location: ../quantri.php');
}   
?>
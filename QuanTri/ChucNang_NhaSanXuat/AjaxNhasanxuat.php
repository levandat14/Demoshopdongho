<?php
if ($_SESSION['tk']) {
?>
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
                <input type="text" class="txtloaisp">
                <input type="submit" class="btnsubmit" value="Thêm">
                </from>
                <div id="truyenvao"></div>
        </div>
    </body>
    <script>
        $(document).ready(function() {
            //load du lieu
            function load_dulieu() {
                $.ajax({
                    url: "ChucNang_NhaSanXuat/Chucnangnhasanxuat.php",
                    method: "post",
                    success: function(data) {
                        $('#truyenvao').html(data);
                    }
                })
            }
            load_dulieu()
            //edit du lieu
            function edit_dulieu(idnsx, text) {
                $.ajax({
                    url: "ChucNang_NhaSanXuat/Chucnangnhasanxuat.php",
                    method: "post",
                    data: {
                        idnsx: idnsx,
                        text: text
                    },
                    success: function(data) {
                        if (data.includes("Dữ liệu đã tồn tại")) {
                            alert(data);
                            load_dulieu();
                        } else {
                            alert('Edit dữ liệu thành công');
                            load_dulieu();
                        }
                    }
                })
            }
            $(document).on('focus', '.tennsx', function() {
                $(this).data('original', $(this).text());
            });
            $(document).on('blur', '.tennsx', function() {
                var idnsx = $(this).data('id');
                var text = $(this).text();
                var originalText = $(this).data('original');
                if (text !== originalText) {
                    edit_dulieu(idnsx, text);
                }
            });

            //delete du lieu
            function delete_dulieu(mansx) {
                $.ajax({
                    url: "ChucNang_NhaSanXuat/Chucnangnhasanxuat.php",
                    method: "post",
                    data: {
                        mansx: mansx
                    },
                    success: function(data) {
                        if (data.includes("Không thể xóa nhà sản xuất này vì đang tồn tại sản phẩm với mã nhà sản xuất")) {
                            alert(data);
                            load_dulieu();
                        } else {
                            alert('Xóa dữ liệu thành công');
                            load_dulieu();
                        }
                    }
                });
            }
            $(document).on('click', '.btnxoa', function() {
                var mansx = $(this).data('id');
                delete_dulieu(mansx)
            })
            //insert du lieu
            $(".btnsubmit").on('click', function() {
                var insert = $('.txtloaisp').val();
                if (insert != '') {
                    $.ajax({
                        url: "ChucNang_NhaSanXuat/Chucnangnhasanxuat.php",
                        method: "post",
                        data: {
                            insert: insert
                        },
                        success: function(data) {
                            if (data.includes("Dữ liệu đã tồn tại")) {
                                alert(data);
                                load_dulieu();
                            } else {
                                alert('Thêm dữ liệu thành công');
                                load_dulieu();
                            }
                        }
                    })
                } else {
                    alert('Khong duoc de trong');
                    load_dulieu()
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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  

  <link href="css/style.css" rel="stylesheet" />
  <?php
    require_once("../ketnoi/ketnoi.php");
    $error_xacnhanmatkhau = null;
    $error_taikhoan =null;
    if (isset($_POST['btnsubmit'])) {
        $ho_ten = $_POST['txtname'];
        //xử lý tk
        $tam=$_POST['txttendangnhap'];
        $sqlt = "SELECT * FROM khachhang WHERE TaiKhoan='$tam'";
        $queryt = mysqli_query($conn, $sqlt);
        $rowt = mysqli_fetch_array($queryt);
        if ($rowt <= 0) {
            $ten_dang_nhap = $tam;
        } else {

            $error_taikhoan = "(*Tài khoản đã tồn tại*)";
        }
        // xử lý mk
        $mat_khau = $_POST['txtmatkhau'];
        if ($_POST['txtxacnhanmatkhau'] !=$mat_khau) {
            $error_xacnhanmatkhau = "(*Xác Nhận Mật Khẩu Không Đúng*)";
        }else{
            $xac_nhan_mat_khau=$_POST['txtxacnhanmatkhau'];
            $mat_khau_Ma_Hoa=md5($xac_nhan_mat_khau);
        }
        // xử lý email
            $email = $_POST['txtemail'];
            $dia_chi = $_POST['txtdiachi'];
            $sdt = $_POST['txtsdt'];
           
            if (isset($ho_ten) && isset($ten_dang_nhap) && isset($xac_nhan_mat_khau) && isset($email) && isset($dia_chi) && isset($sdt)) {
                $sql = "INSERT INTO  khachhang(TenKH, TaiKhoan, MatKhau, Email, DiaChi, SDT) VALUES 
            ('$ho_ten', '$ten_dang_nhap', '$mat_khau_Ma_Hoa', '$email',' $dia_chi',' $sdt' )";
                $query = mysqli_query($conn, $sql);
               
                echo '<script>alert("Chúc mừng quý khách đã đăng kí thành công, Mời quý khách quay lại để đăng nhập");
                window.location.href="Dangki.php";
                </script>' ;
    
               
               
                
            }
            
        
    }
    ?>

  <form method="post">

      <body class="img js-fullheight" style="background-image: url('Img_DangNhap/bg1.jpg'); background-size: cover">
          <div class="row justify-content-center">
              <div class="col-md-6 text-center mb-5">
                  <h2 class="heading-section">ĐĂNG KÝ  VIÊN</h2>
              </div>
          </div>
          <div class="row justify-content-center">
              <div class="col-md-6 col-lg-4">
                  <div class="login-wrap p-0">
                      <div class="form-group">
                          <a> Họ Tên Khách Hàng</a>
                          <div class="col-md-10">
                              <input required class="form-control" type="text" name="txtname"  value="<?php echo isset($_POST['txtname'])? $_POST['txtname']: "";  ?>"  />
                          </div>
                      </div>

                      <div class="form-group">
                          <a>Tên Đăng Nhập</a>
                          <span style="color:red;"> <?php if (isset($error_taikhoan)) {
                                echo $error_taikhoan;
                            } ?></span>
                          <div class="col-md-10">
                              <input required class="form-control" type="text" name="txttendangnhap" value="<?php echo isset($_POST['txttendangnhap'])? $_POST['txttendangnhap']: "";  ?>" />
                          </div>
                      </div>

                      <div class="form-group">
                          <a>Mật Khẩu</a>
                          <div class="col-md-10" style="height:53px">
                              <input required type="password" name="txtmatkhau" class="form-control" id="password-field">
                              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>


                          </div>
                      </div>

                      <div class="form-group">
                          <a>Xác Nhận Mật Khẩu</a>
                        
                          <span style="color:red;"> <?php if (isset($error_xacnhanmatkhau)) {
                                echo $error_xacnhanmatkhau;
                            } ?></span>
                          <div class="col-md-10">
                              <input required class="form-control" type="password" name="txtxacnhanmatkhau" />
                          </div>
                      </div>

                      <div class="form-group">
                          <a>Email</a>
                          <div class="col-md-10">
                              <input required class="form-control " type="email" name="txtemail"  value="<?php echo isset($_POST['txtemail'])? $_POST['txtemail']: "";  ?>"  />
                          </div>
                      </div>

                      <div class="form-group">
                          <a>Địa Chỉ</a>
                          <div class="col-md-10">
                              <input required class="form-control" type="text" name="txtdiachi"  value="<?php echo isset($_POST['txtdiachi'])? $_POST['txtdiachi']: "";  ?>" />
                          </div>
                      </div>

                      <div class="form-group">
                          <a>Số Điện Thoại</a>
                          <div class="col-md-10">
                              <input required class="form-control" type="tel" name="txtsdt"  placeholder="Nhập đúng số điện thoại bắt đầu là 0" pattern="[0][0-9]{9}"  value="<?php echo isset($_POST['txtsdt'])? $_POST['txtsdt']: "";  ?>" />
                          </div>
                      </div>
                      <div class="g-recaptcha" data-sitekey="6LcHOJcpAAAAAO5InVkNo-ICMiAhYgNPLrQF6Ymw"></div>
                      <div class="form-group">
                          <div class="col-md-offset-2 col-md-10">
                              <button type="submit" class="form-control btn btn-primary submit px-3" name="btnsubmit">Đăng Ký</button>
                          </div>
                      </div>
                      <div>

                          <a><span class="glyphicon glyphicon-user">Bạn Đã Có Tài Khoản?</span><a href="../index.php?page_layout=dangnhap">Đăng Nhập</a></a>
                      </div>

                  </div>
              </div>
          </div>

          <script src="js/jquery.min.js"></script>
          <script src="js/popper.js"></script>
          <script src="js/bootstrap.min.js"></script>
          <script src="js/main.js"></script>
      </body>
  </form>

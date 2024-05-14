<?php
if (!isset($_SESSION)) {
  session_start();
}
include './connect_db.php';
 
?>
<style>
  * {
    box-sizing: border-box;
  }

  input[type=text],
  select,
  textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
  }
  input[type=email],
  select,
  textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
  }
  input[type=phone],
  select,
  textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
  }
  label {
    padding: 12px 12px 12px 0;
    display: inline-block;
  }

  input[type=submit] {
    background-color: red;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
  }

  input[type=submit]:hover {
    background-color: #e3131d;
  }



  .col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
  }

  .col-75 {
    float: left;
    width: 75%;
    margin-top: 6px;
  }

  .row:after {
    content: "";
    display: table;
    clear: both;
  }

  /* Bố cục linh hoạt: khi màn hình có chiều rộng dưới 600px thì hai cột chồng 
lên nhau thay vì nằm cạnh nhau */
  @media screen and (max-width: 600px) {

    .col-25,
    .col-75,
    input[type=submit] {
      width: 100%;
      margin-top: 0;
    }
  }
</style>
<!DOCTYPE html>
<html lang="vi">

<head>
  <title>QLapTop mua bán thiết bị điện tử giá rẻ</title>
  <meta name="description" content="Chuyên cung cấp đầy đủ linh kiện điện tử đáp ứng theo nhu cầu của khách hàng">
  <meta name="keywords" content="">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="css/home.css">
  <script type="text/javascript" src="js/main.js"></script>
  <link rel="stylesheet" href="fontawesome_free_5.13.0/css/all.css">
  <link rel="stylesheet" href="css/sach-moi-tuyen-chon.css">
  <link rel="stylesheet" href="css/reponsive.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
  <link rel="stylesheet" type="text/css" href="css/grid.css" />
  <script type="text/javascript" src="slick/slick.min.js"></script>
  <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
  <link rel="canonical" href="">
  <meta name="google-site-verification" content="urDZLDaX8wQZ_-x8ztGIyHqwUQh2KRHvH9FhfoGtiEw" />
  <link rel="icon" type="logo/png" sizes="32x32" href="logo/logo.png">
  <link rel="manifest" href="favicon_io/site.webmanifest">
  <style>
    img[alt="www.000webhost.com"] {
      display: none;
    }
  </style>
</head>

<body>
  <!-- code cho nut like share facebook  -->
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0"></script>
  <?php
  include 'main/header/pre-header.php'
  ?>

  <?php
  include 'main/header/danhmuc.php';
  ?>
  <?php
  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $address = isset($_POST['address']) ? $_POST['address'] : '';
  $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
  if ($name == '' || $address == '' || $phone == '' || $email = '') {
  ?>
    
    <div id="edit-notify" class="box-content" align="center">
      <h4><?= "Vui lòng điền đầy đủ thông tin của bạn" ?></h4>
    </div>  
  <?php
  }
  ?>
  <section class="content my-4">
    <div class="container">
      <form action="./danhsachdathang.php" method="post">
        <div class="row">
          <div class="col-25">
            <label for="fname">Họ và tên</label>
          </div>
          <div class="col-75">
            <input type="text" id="" name="name" placeholder="Tên của bạn" >
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="fname">Email</label>
          </div>
          <div class="col-75">
            <input type="email" id="" name="email" placeholder="Nhập email của bạn">
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="country">Địa chỉ</label>
          </div>
          <div class="col-75">
            <input type="text" id="" name="address" placeholder="Địa chỉ">
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="subject">Số điện thoại</label>
          </div>
          <div class="col-75">
            <input type="phone" id="" name="phone" placeholder="Số điện thoại">
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="subject">Nội dung</label>
          </div>
          <div class="col-75">
            <textarea name="content" id="" cols="30" rows="10" placeholder="Nội dung"></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-25">
            <label for="subject">Phương thức thanh toán</label>
          </div>
          <div class="col-75">
            <input type="radio" name="payment_method" value="vnpay" >
            <label for="vnpay">VNPAY</label>
            <input type="radio" name="ttknh" value="ttknh" >
            <label for="ttknh">Thanh toán khi nhận hàng</label><br>
          </div>
        </div>
        <div class="row">
          <input type="submit" name="send" value="Xác nhận">
        </div>
      </form>
    </div>
  </section>

  <div class="fixed-bottom">
    <div class="btn btn-warning float-right rounded-circle nutcuonlen" id="backtotop" href="#" style="background:#CF111A;"><i class="fa fa-chevron-up text-white"></i></div>
  </div>
  <?php
  include 'main/footer/dichvu.php';
  ?>
  <?php
  include 'main/footer/footer.php';
  ?>

</body>

</html>
<link rel="icon" type="logo/png" sizes="32x32" href="logo/logo.png">
<?php
if (!isset($_SESSION)) {
    session_start();
}
include './connect_db.php';
include "./config_vnpay.php";


$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$orderid = rand(0, 999999);
$userid = $_SESSION['user']['id'];
$error = [];
if ($name == '' || $address == '' || $phone == '' || $email == '') {
?>
    <!-- <script>
        alert("Hello\nHow are you?");
    </script> -->
<?Php
} else {
    $total_price = 0;
    $result = mysqli_query($con, "INSERT INTO `orders`(`id`,`user_id`,`name`,`email`,`phone`,`address`,`content`,`created_time`,`last_updated`,`status`) VALUES ('$orderid','$userid','$name','$email','$phone','$address','$content','" . time() . "','" . time() . "','0')");
    foreach ($_SESSION['cart'] as $value) {
        $result = mysqli_query($con, "INSERT INTO `orders_detail`(`order_id`,`product_id`,`product_name`,`quantity`,`image`,`price`) VALUES ('$orderid', '" . $value['id'] . "','" . $value['name'] . "','" . $value['quantity'] . "','" . $value['image'] . "' ,'" . $value['price'] . "')");
        $total_price += $value['price'] * $value['quantity'];
    }

    $vnp_TxnRef = $orderid; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
    $vnp_OrderInfo = "Thanh toán GD: " . $vnp_TxnRef;
    $vnp_OrderType = "other";
    $vnp_Amount = $total_price * 100;
    $vnp_Locale = "vn";
    $vnp_BankCode = "NCB";
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    $inputData = array(
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
        "vnp_ExpireDate" => $expire
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }
    $returnData = array(
        'code' => '00', 'message' => 'success', 'data' => $vnp_Url
    );
    if (isset($_POST['payment_method'])) {
        header('Location: ' . $vnp_Url);
        die();
    } else {
        echo json_encode($returnData);
    }
}
$sql = mysqli_query($con, "SELECT * FROM orders WHERE `user_id`= $userid");
$sql = mysqli_fetch_all($sql, MYSQLI_ASSOC);
// echo"<pre>";
// print_r($sql);
?>
<?php
include  "PHPMailer/src/PHPMailer.php";
include  "PHPMailer/src/Exception.php";
include  "PHPMailer/src/OAuth.php";
include  "PHPMailer/src/POP3.php";
include  "PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
?>
<?php
if (isset($_POST['send'])) {
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'phuchuu1122@gmail.com';               
        $mail->Password = 'kocxvuhfwrfqvins';                         
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->CharSet = "UTF-8";
        $mail->setFrom('ComputerStore@gmail.com', 'Computerstore.com');
        $mail->addAddress($_POST['email'], $_POST['name']);

        $mail->isHTML(true);
        $mail->Subject = "Xác nhận đơn hàng thành công";
        $mail->Body    = " Xin chào quý khách hàng:  <br>
                            Cảm ơn quý khách đã mua sản phẩm tại website: ComputerStore <br>";
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Bạn chưa nhập đủ thông tin Mailer Error: ', $mail->ErrorInfo;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Nguyễn Văn Quân chuyên mua bán thiết bị điện tử và laptop giá rẻ</title>
    <meta name="description" content="Chuyên cung cấp đầy đủ linh kiện điện tử đáp ứng theo nhu cầu của khách hàng">
    <meta name="keywords" content="nhà sách online, mua sách hay, sách hot, sách bán chạy, sách giảm giá nhiều">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="logo/png" sizes="32x32" href="logo/logo.png">
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
    <link rel="manifest" href="favicon_io/site.webmanifest">
    <style>
        img[alt="www.000webhost.com"] {
            display: none;
        }
    </style>
    <style>
        .btn-blue {
            border-color: white;
            background-color: #00badf;
            color: white;
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
    <section class="content my-4">
        <div class="container">
            <h3 class="text-center">
                Đơn hàng của bạn
            </h3>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>SDT</th>
                        <th>Địa chỉ</th>
                        <th>Nội dung</th>
                        <th>Tình trạng</th>
                        <th>Chi tiết đơn hàng</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($sql as $value) {
                    ?>
                        <tr>
                            <td><?php echo $value['id'] ?></td>
                            <td><?php echo $value['name'] ?></td>
                            <td><?php echo $value['email'] ?></td>
                            <td><?php echo $value['phone'] ?></td>
                            <td><?php echo $value['address'] ?></td>
                            <td><?php echo $value['content'] ?></td>
                            <?php
                            if ($value['status'] == 0) {
                                echo '<td class="text-danger">Đang Xử Lý</td>';
                            } elseif ($value['status'] == 1) {
                                echo '<td class="text-success">Đang Giao Hàng</td>';
                            } elseif ($value['status'] == 2)
                                echo '<td class="text-success">Thành Công</td>';
                            else
                                echo '<td class="text-danger">Đơn hàng bị hủy</td>';
                            ?>
                            <td><a href="chitietdonhang.php?id= <?php echo $value['id']  ?> " class="btn btn-blue">Chi tiết </a></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

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
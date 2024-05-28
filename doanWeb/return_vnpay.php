<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VNPAY RESPONSE</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>
    <?php
    require_once "./config_vnpay.php";
    $vnp_SecureHash = $_GET['vnp_SecureHash'];
    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }

    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
    }

    $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    ?>
    <!--Begin display -->
    <div class="container mt-5">
        <div class="header clearfix">
            <h3 class="text-center text-muted">VNPAY RESPONSE</h3>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Mã đơn hàng:</td>
                        <td><?php echo $_GET['vnp_TxnRef'] ?></td>
                    </tr>
                    <tr>
                        <td>Số tiền:</td>
                        <td><?php echo number_format($_GET['vnp_Amount'], 0, ",", ".") . "đ" ?></td>
                    </tr>
                    <tr>
                        <td>Nội dung thanh toán:</td>
                        <td><?php echo $_GET['vnp_OrderInfo'] ?></td>
                    </tr>
                    <tr>
                        <td>Mã phản hồi (vnp_ResponseCode):</td>
                        <td><?php echo $_GET['vnp_ResponseCode'] ?></td>
                    </tr>
                    <tr>
                        <td>Mã GD Tại VNPAY:</td>
                        <td><?php echo $_GET['vnp_TransactionNo'] ?></td>
                    </tr>
                    <tr>
                        <td>Mã Ngân hàng:</td>
                        <td><?php echo $_GET['vnp_BankCode'] ?></td>
                    </tr>
                    <tr>
                        <td>Thời gian thanh toán:</td>
                        <td><?php echo $_GET['vnp_PayDate'] ?></td>
                    </tr>
                    <tr>
                        <td>Kết quả:</td>
                        <td>
                            <?php
                            if ($secureHash == $vnp_SecureHash) {
                                if ($_GET['vnp_ResponseCode'] == '00') {
                                    echo "<span style='color:blue'>Giao dịch Thành công</span>";
                                } else {
                                    echo "<span style='color:red'>Giao dịch không thành công</span>";
                                }
                            } else {
                                echo "<span style='color:red'>Chu ky khong hop le</span>";
                            }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- back button -->
            <div class="form-group text-center">
                <a href="index.php" class="btn btn-primary">Quay lại trang chủ</a>
            </div>
        </div>
        <p>&nbsp;</p>
        <footer class="footer text-center">
            <p>&copy; VNPAY <?php echo date('Y') ?></p>
        </footer>
    </div>
</body>

</html>
<style> 
        .has-error {
            color: violet;
        }
    </style>
<?php
if(!isset($_SESSION))
{
    session_start();
}
include 'connect_db.php';
$loi = [];
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    if(empty($email))
    {
        $loi['email'] = "Bạn chưa nhập email";
    }
    if (empty($loi)) {
        $sql = mysqli_query($con, "SELECT * FROM `user` WHERE `email` = '$email'");
        // print_r($sql);
        $test = mysqli_num_rows($sql);
        // print_r($test);
        if ($test==0) {
            $loi['email'] ="Email không tồn tại";
        }
        else{
            $result= sendnewpd($email);
        }
    }
   
}
?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
?>
<?php
function sendnewpd($email)
{
include  "PHPMailer/src/PHPMailer.php";
include  "PHPMailer/src/Exception.php";
include  "PHPMailer/src/OAuth.php";
include  "PHPMailer/src/POP3.php";
include  "PHPMailer/src/SMTP.php";
$mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'phuchuu0120@gmail.com';
            $mail->Password = 'txdddwqkmrttaqiu';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->CharSet="UTF-8";
            $mail->setFrom('ComputerStore@gmail.com', 'Computerstore.com');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Thư gửi lại mật khẩu";
            $mail->Body    = " <form method='POST' action='http://localhost/doanWeb/kichhoat.php' >
                                <input type='hidden' name='email' value='$email'>
                                Vui lòng truy cập <button type='submit'> Tại đây</button> để đổi lại mật khẩu
                                </form> ";
            // " Xin chào quý khách hàng:  <br>
            //                 Password của quý khách là : <a href ='http://localhost/doanWeb/kichhoat.php'> Nhấn vào đây</a>  <br>";
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
             
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link rel="icon" type="logo/png" sizes="32x32" href="logo/logo.png">
<form method="post" style="width:600px" class="border border-primary border-2 m-auto p-2">
    <h4 class="mb-3 text-center" >
        QUÊN MẬT KHẨU
    </h4>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input value="<?php if(isset($email)) echo $email  ?>" type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
    <div class="has-error">
                    <span>
                        <?php echo (isset($loi['email'])) ? $loi['email']:''?>
                    </span>
                </div>
  </div>
  <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
</form>
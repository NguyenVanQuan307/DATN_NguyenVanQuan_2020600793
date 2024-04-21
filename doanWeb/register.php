<style>
    .gioitinh{
    min-width: 200px;
    height: 30px;
    border: 1px solid #ccc;
    border-radius: 5px;
    }
</style>
<?php
    if(!isset($_SESSION))
    {
        session_start();
    } 
    include './connect_db.php';
    $error = [];
    if(isset($_POST['fullname']))
    {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $rpassword = $_POST['rpassword'];
        $sdt = $_POST['sdt'];
        $gioitinh = $_POST['gioitinh'];
        if(empty($fullname))
        {
            $error['fullname'] ='Bạn chưa nhập tên';
        }
        if(empty($email))
        {
            $error['email'] ='Bạn chưa nhập email';
        }
        if(empty($username))
        {
            $error['username'] ='Bạn chưa nhập tên đăng nhập';
        }
        if(empty($password))
        {
            $error['password'] ='Bạn chưa nhập mật khẩu';
        }
        if($password != $rpassword)
        {
            $error['rpassword'] ='Mật khẩu nhập lại không đúng';
        }
        if(empty($sdt))
        {
            $error['sdt'] ='Bạn chưa nhập sdt';
        }
        if(empty($gioitinh))
        {
            $error['gioitinh'] ='Bạn chưa nhập Giới tính';
        }
        if(empty($error))
        {
        $sql = mysqli_query($con,"INSERT INTO `user`(`fullname`, `email`, `username`, `password`, `sdt`, `gioitinh`, `created_time`, `last_updated`) VALUES ('$fullname','$email', '$username', MD5('$password'),'$sdt', '$gioitinh', " . time() . ", '" . time() . "')");
       
        if($sql)
        {
            ?>
                         <div id="edit-notify" class="box-content">
                                <h1><?=   "Đăng ký tài khoản thành công" ?></h1>
                                <a href="./login.php">Mời bạn đăng nhập</a>
                            </div>
            <?php
        }
        }
    }
?>
<!DOCTYPE html>
<html>
    <style>
        .has-error {
            color: violet;
        }
    </style>
<head>
<title>Register</title>
<!-- for-mobile-apps -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="User Register Form Widget Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- //for-mobile-apps -->
<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300italic,300,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Amaranth:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link rel="icon" type="logo/png" sizes="32x32" href="logo/logo.png">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
    <div class="content">
		<h1>User Register Form Widget</h1>
		<div class="main">
			<h2>Register For Free Account</h2>
			
			<form action="./register.php?action=reg" method="Post" autocomplete="off">
                <h5>Họ và tên</h5>
                <input type="text" name="fullname" value="" /><br/>
                <div class="has-error">
                    <span>
                        <?php echo (isset($error['fullname'])) ? $error['fullname']:''?>
                    </span>
                </div>
				<h5>Email</h5>
				<input type="email" name="email" value="" /><br/>
                <div class="has-error">
                <span>
                        <?php echo (isset($error['email'])) ? $error['email']:''?>
                    </span>
                </div>
				<h5>Username</h5>
				<input type="text" name="username" value=""><br/>
                <div class="has-error">
                <span>
                        <?php echo (isset($error['username'])) ? $error['username']:''?>
                    </span>
                </div>
                <h5>Password</h5>
				<input type="password" name="password" value="" /></br>
                <div class="has-error">
                <span>
                        <?php echo (isset($error['password'])) ? $error['password']:''?>
                    </span>
                </div>
                <h5>Re-Password</h5>
				<input type="password" name="rpassword" value="" /></br>
                <div class="has-error">
                <span>
                        <?php echo (isset($error['rpassword'])) ? $error['rpassword']:''?>
                    </span>
                </div>
                <h5>SĐT</h5>
                <input type="phone" name="sdt" value="" /><br/>
                <div class="has-error">
                <span>
                        <?php echo (isset($error['sdt'])) ? $error['sdt']:''?>
                    </span>
                </div>
				<h5>Giới tính</h5>
                <div class="has-error">
                <select name="gioitinh" class="gioitinh" >
                    <span>
                        <?php echo (isset($error['gioitinh'])) ? $error['gioitinh']:''?>
                        <option  value="Nam">Nam</option>
                        <option  value="Nữ">Nữ</option>
                    </span>
                    </select>
                </div>
				<input type="submit" value="Đăng ký">
			</form>
		</div>
	</div>

</body>
</html>
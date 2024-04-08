<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Đổi thông tin người dùng</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .box-content{
                margin: 0 auto;
                width: 800px;
                border: 1px solid #ccc;
                text-align: center;
                padding: 20px;
            }
            #edit_user form{
                width: 200px;
                margin: 40px auto;
            }
            #edit_user form input{
                margin: 5px 0;
            }
        </style>
    </head>
    <body>
        <?php
        include './connect_db.php';
        $error = false;
        if (isset($_GET['action']) && $_GET['action'] == 'edit') {
            if (isset($_POST['id']) && !empty($_POST['id']) ) {
                $id= $_POST['id'];
                $result = mysqli_query($con, "UPDATE `orders` SET `status` = " . $_POST['status'] . " WHERE `id` = $id ");
                if (!$result) {
                    $error = "Không thể cập nhật ";
                }
                mysqli_close($con);
                if ($error !== false) {
                    ?>
                    <div id="error-notify" class="box-content">
                        <h1>Thông báo</h1>
                        <h4><?= $error ?></h4>
                        <a href="./dathang.php">Danh sách khách hàng</a>
                    </div>
                <?php } else { ?>
                    <div id="edit-notify" class="box-content">
                        <h1><?= ($error !== false) ? $error : "Thay đổi thành công" ?></h1>
                        <a href="./dathang.php">Danh sách khách hàng</a>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div id="edit-notify" class="box-content">
                    <h1>Vui lòng nhập đủ thông tin để sửa thông tin</h1>
                    <a href="./dathang.php?id=<?= $_POST['id'] ?>">Quay lại sửa thông tin</a>
                </div>
            <?php
            }
        } else {
            $result = mysqli_query($con, "SELECT * FROM orders where `id`=" . $_GET['id']);
            $user = mysqli_fetch_assoc($result);
            // echo"<pre>";
            // print_r($user);
            mysqli_close($con);
            if (!empty($user)) {
                ?>
                <div id="edit_user" class="box-content">
                    <h1>Sửa tài khoản "<?= $user['id'] ?>"</h1>
                    <form action="./edit_donhang.php?action=edit" method="Post" autocomplete="off">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>" />
                        <select name="status">
                            <option <?php $user['status'] ?> value="0">Đang xử lý</option>
                            <option <?php $user['status'] ?> value="1">Đang giao hàng</option>
                            <option <?php $user['status'] ?> value="2">Thành công</option>
                            <option <?php $user['status'] ?> value="3">Đơn hàng bị hủy</option>
                        </select>
                        <br><br>
                        <input type="submit" value="Edit" />
                    </form>
                </div>
            <?php
            }
        }
        ?>
    </body>
</html>

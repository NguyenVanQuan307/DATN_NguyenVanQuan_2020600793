<?php
if(!isset($_SESSION))
{
    session_start();
}
include './connect_db.php';
$name = isset($_POST['name']) ? $_POST['name'] : ''; 
$review = isset($_POST['review']) ? $_POST['review'] : ''; 
// $error = []; 
if($name == '' || $review == '')
{
    ?>
    // $error['name'] = "Bạn chưa nhập tên";
    // $error['review'] = "Bạn chưa nhập bình luận";
    <script>alert('Bạn chưa nhạp tên hoặc bình luận')
        window.location("chitietsp.php?id=".$_REQUEST['id'])
</script>
    
    <?php
}
else
{
        mysqli_query($con,"INSERT INTO `rate`(`product_id`,`user_id`,`name`,`rate`,`review`) VALUES ('".$_REQUEST['id']."','".$_SESSION['user']['id']."','".$_POST['name']."','".$_POST['star']."','".$_POST['review']."')");
}
header("Location: chitietsp.php?id=".$_REQUEST['id']);
exit();
?>
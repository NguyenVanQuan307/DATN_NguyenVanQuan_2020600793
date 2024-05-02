<?php
include 'connect_db.php';
if(!isset($_SESSION))
{
    session_start();
}
if(isset($_GET['id']))
{
    $id = $_GET['id'];
}
$action = (isset($_GET['action'])) ? $_GET['action'] : 'add';
$quantity = (isset($_GET['quantity'])) ? $_GET['quantity'] : 1;

if($quantity <= 0)
{
    $quantity = 1;
}
//  session_destroy();
// echo $action;
// echo"<br>";
// echo $id;
// echo "<pre>";
// var_dump($action);
// die();
$sql = mysqli_query($con,"SELECT * FROM `product` WHERE `id` = $id");

if($sql)
{
    $product = mysqli_fetch_assoc($sql);
}


$item = ['id' => $product['id'],
        'name' => $product['name'],
        'image' => $product['image'],
        'price' =>$product['price_new'],
        'quantity' => $quantity ];

if($action == 'add')
{
    if(isset($_SESSION['cart'][$id]))
    {
        $_SESSION['cart'][$id]['quantity'] +=$quantity;
    }
    else
    {
        $_SESSION['cart'][$id] = $item;
    }
}
if($action == 'update')
{
    $_SESSION['cart'][$id]['quantity'] = $quantity;
}
if($action == 'delete')
{
    unset($_SESSION['cart'][$id]);
}


 header('location: ./chitietgiohang.php');
//  echo"<pre>";
// print_r($_SESSION['cart']);

//thêm mới giỏ hàng

//cập nhật giỏ hàng

//xóa sản phẩm khỏi giỏ hàng
?>
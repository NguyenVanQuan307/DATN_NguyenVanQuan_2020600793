<?php
if(isset($_SESSION['user']))
{
    ?>
<ul class="navbar-nav mb-1 ml-auto">
                <li class="nav-item giohang">
                        <a href="chitietgiohang.php" class="btn btn-secondary rounded-circle">
                            <i class="fa fa-shopping-cart"> 
                                <?php if(isset($_SESSION['cart']))
                            {
                                $cart1 = count($_SESSION['cart']);
                                echo $cart1 ;
                            }
                            else
                            {
                                $cart1 = 0 ;
                                echo $cart1 ;
                            }
                            
                            ?>
                            </i>
                        </a>
                        <a class="nav-link text-dark giohang text-uppercase" href="chitietgiohang.php"
                            style="display:inline-block">Giỏ
                            Hàng</a>
                    </li>
                </ul>
    <?php
}
else
{
    ?>
<ul class="navbar-nav mb-1 ml-auto" style="display: none">
                <li class="nav-item giohang">
                        <a href="chitietgiohang.php" class="btn btn-secondary rounded-circle ">
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                        <a class="nav-link text-dark giohang text-uppercase " href="chitietgiohang.php"
                            style="display:inline-block">Giỏ
                            Hàng</a>
                    </li>
                </ul>
    <?php
}
?>

                
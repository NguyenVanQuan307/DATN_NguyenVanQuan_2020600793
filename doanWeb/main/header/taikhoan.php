<?php
include './connect_db.php';
 $user=(isset( $_SESSION['user'])) ? $user = $_SESSION['user'] : [];
?>
<ul class="navbar-nav mb-1 ml-auto">
                    
                            <?php if(isset($user['username'])){ ?>
                            
                                <div class="dropdown">
                                <li class="nav-item account" type="button" class="btn dropdown" data-toggle="dropdown">
                                
                                <a class="nav-link text-dark text-uppercase" href="#" style="display:inline-block"> <?php echo $user['fullname'] ?> </a>
                                
                            </li>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a  href="danhsachdathang.php" class="dropdown-item nutdangky text-center mb-2">Đơn hàng của bạn</a>
                                <a  href="doimatkhau.php" class="dropdown-item nutdangky text-center mb-2">Đổi mật khẩu</a>
                                <a  href="logout.php" class="dropdown-item nutdangky text-center mb-2">Đăng xuất</a>
                                
                            </div>

                     <?php }else { ?>
                        <div class="dropdown">
                                <li class="nav-item account" type="button" class="btn dropdown" data-toggle="dropdown">
                                 <a href="#" class="btn btn-secondary rounded-circle">
                                <i class="fa fa-user"></i>
                                </a>
                                <a class="nav-link text-dark text-uppercase" href="#" style="display:inline-block"> Tài khoản </a>
                                
                            </li>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a  href="register.php" class="dropdown-item nutdangky text-center mb-2">Đăng ký</a>
                                <a href="login.php" class="dropdown-item nutdangnhap text-center"  >Đăng nhập</a>
                            </div>
                        <?php } ?>
                    </div>
                    
                </ul>
                
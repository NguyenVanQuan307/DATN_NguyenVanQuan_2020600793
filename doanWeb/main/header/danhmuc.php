<?php
include'connect_db.php';
?>
<section class="duoinavbar">
        <div class="container text-white">
            <div class="row justify">
                <div class="col-lg-3 col-md-5 " >
                    <div class="categoryheader">
                        <div class="noidungheader text-white">
                            <i class="fa fa-bars"></i>
                            <span  class="text-uppercase font-weight-bold ml-1">Danh mục </span>
                        </div>
                        <!-- CATEGORIES -->
                        <div class="categorycontent">
                        <ul>
                            <?php
                                $listcat = "SELECT * FROM menu_product order by id asc";
                                $result = mysqli_query($con,$listcat);
                                while ($row = mysqli_fetch_array($result))
                                {
                            ?>
                            <li> <a href="danhsachsp.php?id=<?php echo $row['id']?>"> <?php echo $row['name']?> </a><i class=" "></i>
                            </li>
                            <?php
                                }
                            ?>
                        </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 ml-auto contact d-none d-md-block">
                    <div class="benphai float-right">
                        <div class="hotline">
                            <i class="fa fa-phone"></i>
                            <span>Hotline: 0326185212<b></b> </span>
                        </div>
                        <i class="fas fa-comments-dollar"></i>
                        <a href="#">anhquan30721@gmail.com</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
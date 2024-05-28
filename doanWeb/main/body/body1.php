<style>
    .btn-chitiet{
            color: #fff;
    background-color: #ffc107;
    border-color: #ffc107;
    }
</style>
<section class="_1khoi sachmoi bg-white">
        <div class="container">
                <div class="row">
                    <!--header-->
                    <div class="col-12 d-flex justify-content-between align-items-left pb-2 bg-transparent pt-4">
                        <h1 class="header text-uppercase" style="font-weight: 400;">Các sản phẩm được ưa chuộng nhiều nhất </h1>
                        <a href="tongsp.php" class="btn btn-warning btn-sm text-white">Xem tất cả</a>
                    </div>
                </div>
                <div class="khoisanpham" style="padding-bottom: 2rem;">
                <?php
                                $sql = "SELECT * FROM product WHERE menu_id=1 LIMIT 8 ";
                                $result = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_array($result))
                                {
                            ?>
                    <div class="col-lg-3 col-md-4 col-xs-6">
                       <div class="card-item">
                           <a href="chitietsp.php?id= <?php echo $row['id'] ?>" class="motsanpham"
                               style="text-decoration: none; color: black;" data-toggle="tooltip"
                               data-placement="bottom" title="">
                               <img class="card-img-top anh" src="<?php echo $row['image'];?>" >
                               <div class="card-body noidungsp mt-3">
                                   <h6 class="card-title ten"><?php echo $row['name']; ?></h6>
                                   <a href="chitietsp.php?id= <?php echo $row['id'] ?>  " class="btn btn-success" role="button">Chi tiết</a>
                                   <div class="gia d-flex align-items-baseline">
                                   <div class="giamoi"> <?php  echo number_format ($row['price_new'])  ?> đ</div> 
                                   </div>
                               </div>
                           </a>
                       </div>
                     </div>
                            <?php
                                }
                            ?>
                </div>
        </div>


        <div class="container">
                <div class="khoisanpham" style="padding-bottom: 2rem;">
                <?php
                                $sql = "SELECT * FROM product WHERE menu_id=2 LIMIT 8";
                                $result = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_array($result))
                                {
                            ?>
                    <div class="col-lg-3 col-md-4 col-xs-6">
                       <div class="card-item">
                           <a href="chitietsp.php?id= <?php echo $row['id'] ?>" class="motsanpham"
                               style="text-decoration: none; color: black;" data-toggle="tooltip"
                               data-placement="bottom" title="">
                               <img class="card-img-top anh" src="<?php echo $row['image'];?>" >
                               <div class="card-body noidungsp mt-3">
                                   <h6 class="card-title ten"><?php echo $row['name']; ?></h6>
                                   <a href="chitietsp.php?id= <?php echo $row['id'] ?>  " class="btn btn-success" role="button">Chi tiết</a>
                                   <div class="gia d-flex align-items-baseline">
                                   <div class="giamoi"> <?php  echo number_format ($row['price']) ; ?> VNĐ</div> 
                                   </div>
                               </div>
                           </a>
                       </div>
                     </div>
                            <?php
                                }
                            ?>
                </div>
        </div>


        <div class="container">
                <div class="khoisanpham" style="padding-bottom: 2rem;">
                <?php
                                $sql = "SELECT * FROM product WHERE menu_id=3 LIMIT 8";
                                $result = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_array($result))
                                {
                            ?>
                    <div class="col-lg-3 col-md-4 col-xs-6">
                       <div class="card-item">
                           <a href="chitietsp.php?id= <?php echo $row['id'] ?>" class="motsanpham"
                               style="text-decoration: none; color: black;" data-toggle="tooltip"
                               data-placement="bottom" title="">
                               <img class="card-img-top anh" src="<?php echo $row['image'];?>" >
                               <div class="card-body noidungsp mt-3">
                                   <h6 class="card-title ten"><?php echo $row['name']; ?></h6>
                                   <a href="chitietsp.php?id= <?php echo $row['id'] ?>  " class="btn btn-success" role="button">Chi tiết</a>
                                   <div class="gia d-flex align-items-baseline">
                                   <div class="giamoi"> <?php  echo number_format ($row['price']) ; ?> VNĐ</div> 
                                   </div>
                               </div>
                           </a>
                       </div>
                     </div>
                            <?php
                                }
                            ?>
                </div>
        </div>


    </section>
   
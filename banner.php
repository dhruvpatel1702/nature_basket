<?php
include"db_connect.php";

$banner_query = "SELECT banner.*, products.price, products.description 
                 FROM banner 
                 LEFT JOIN products ON banner.product_id = products.id";
$banner_data = mysqli_query($conn, $banner_query);
$banner_result = mysqli_fetch_all($banner_data, MYSQLI_ASSOC);
?>





<!-- Banner Section Start-->
 <div class="container-fluid banner bg-secondary my-5">
        <?php foreach ($banner_result as $banner){ ?>
            <div class="container py-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="py-4">
                            <h1 class="display-3 text-white"> Fresh Exotic <?php  echo $banner['banner_name'];?></h1>
                            <p class="fw-normal display-3 text-dark mb-4">in Our Store</p>
                            <p class="mb-4 text-dark"><?php  echo $banner['description']; ?></p>
                             <a href="shop-detail.php" class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">BUY</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative">
                            <img src="admin/images/banner/<?php echo $banner['image'];?>" class="img-fluid w-100 rounded" alt="">
                            <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute" style="width: 140px; height: 140px; top: 0; left: 0;">
                                <!--<h1 style="font-size: 40px;">1</h1>!-->
                                <div class="d-flex flex-column">
                                    <span class="h2 mb-0"><?php echo $banner['price']; ?></span>
                                    <span class="h4 text-muted mb-0">₹/kg</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
  </div>


    


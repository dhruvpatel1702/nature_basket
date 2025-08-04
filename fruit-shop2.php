<?php
include "db_connect.php";

$banner_query = "SELECT banner.*, products.price, products.description 
                 FROM banner 
                 LEFT JOIN products ON banner.product_id = products.id";
$banner_data = mysqli_query($conn, $banner_query);
$banner_result = mysqli_fetch_all($banner_data, MYSQLI_ASSOC);
?>


<!-- Featurs Start -->
<div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-secondary rounded border border-secondary">
                                <img src="admin/images/testimonial/1741597833_vegitable.avif" class="img-fluid rounded-top w-100"  style="width: 354px;height: 286px;">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-primary text-center p-4 rounded">
                                    <a href="shop.php" class="text-primary"><h5 >Fresh vegetables</h5></a>
                                    <a href="shop.php" class="mb-0"><h3>20% OFF</h3></a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-dark rounded border border-dark">
                                <img src="admin/images/banner/mix fruit.png" class="img-fluid rounded-top w-100" style="width: 354px;height: 286px;">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-light text-center p-4 rounded">
                                        <a href="shop.php" class="text-primary"><h5 >Tasty Fruits</h5></a>
                                        <a href="shop.php" class="mb-0"><h3>Free delivery</h3></a> 
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-primary rounded border border-primary"><?php foreach ($banner_result as $banner){ ?>
                                <img src="admin/images/banner/<?php echo $banner['image'];?>" class="img-fluid rounded-top width: 100%" alt style="width: 354px;height: 286px;">
                                
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-secondary text-center p-4 rounded">
                                        <h5 class="text-white">Exotic <?php echo $banner['banner_name'];?> </h5>
                                        <a href="shop-detail.php" class="mb-0"><h3>Discount 10%</h3></a>
                                        
                                    </div>
                                </div>
                                <?php }?>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featurs End -->

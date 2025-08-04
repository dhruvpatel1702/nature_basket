<?php
include "db_connect.php";

$category_query = "
    SELECT c.*, COUNT(p.id) AS product_count 
    FROM category c
    LEFT JOIN products p ON c.id = p.category_id
    GROUP BY c.id
";
$category_data = mysqli_query($conn, $category_query);
$category_result = mysqli_fetch_all($category_data, MYSQLI_ASSOC);

$product_query = "SELECT * FROM products WHERE category_id = (SELECT id FROM category WHERE name = 'Vegetable')";
$product_data = mysqli_query($conn, $product_query);
$product_result = mysqli_fetch_all($product_data, MYSQLI_ASSOC);


$testimonial_query ="SELECT * FROM testimonial";
$testimonial_data =mysqli_query($conn, $testimonial_query);
$testimonial_result = mysqli_fetch_all( $testimonial_data, MYSQLI_ASSOC);


?>
<html>
    <style>
            
        .responsive-table {
            overflow-x: auto;
        }

        .product-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            display: block;
        }

        .responsive-table {
            width: 100%;
            overflow-x: auto;
            display: block;
            white-space: nowrap;
        }

        th,
        td {
            text-align: center;
            vertical-align: middle;
            width: auto;
        }
    
    </style>
</html>

        <!-- Single Product Start -->
        <div class="container-fluid py-5 mt-5">
            <div class="container py-5">
                <div class="row g-4 mb-5">
                    <div class="col-lg-8 col-xl-9">
                        <div class="row g-4">
                           <?php include'single-shop-product.php'; ?>
                            <div class="col-lg-12">
                                <nav>
                                    <div class="nav nav-tabs mb-3">
                                        <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                            id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                            aria-controls="nav-about" aria-selected="true">Description</button>
                                        <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                            id="testimonial" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                            aria-controls="nav-mission" aria-selected="false">Reviews</button>
                                    </div>
                                </nav>
                                <div class="tab-content mb-5">
                                    <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                        <p>Broccoli is a green, cruciferous vegetable belonging to the Brassica oleracea species, known for its dense, branching heads of edible flower buds and a thick, edible stalk, often eaten cooked or raw.  </p>
                                        
                                        <div class="px-2">
                                            <div class="row g-4">
                                                <div class="col-6">
                                                    <div class="row bg-light align-items-center text-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Weight</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0">1 kg</p>
                                                        </div>
                                                    </div>
                                                    <div class="row text-center align-items-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Country of Origin</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0">Agro Farm</p>
                                                        </div>
                                                    </div>
                                                    <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Quality</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0">Organic</p>
                                                        </div>
                                                    </div>
                                                    <div class="row text-center align-items-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Сheck</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0">Healthy</p>
                                                        </div>
                                                    </div>
                                                    <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                        <div class="col-6">
                                                            <p class="mb-0">Min Weight</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="mb-0">250 Kg</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Review Start!-->
                                    <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                        <?php  foreach($testimonial_result as $testimonial) { ?>
                                        <div class="d-flex">
                                            <img src="admin/images/testimonial/<?php echo $testimonial['image']; ?>" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                            <div class="">
                                                <p class="mb-2" style="font-size: 14px;"><?php echo $testimonial['created_at']; ?></p>
                                                <div class="d-flex justify-content-between">
                                                    <h5><?php echo $testimonial['name']; ?></h5>
                                                    
                                                </div>
                                                <p><?php  echo $testimonial['description'];?> </p>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="tab-pane" id="nav-vision" role="tabpanel">
                                        <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                            amet diam et eos labore. 3</p>
                                        <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                            Clita erat ipsum et lorem et sit</p>
                                    </div>
                                </div>
                            </div>
                            <?php include'reply-testimonial.php'; ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xl-3">
                        <div class="row g-4 fruite">
                            <div class="col-lg-12">
                                <div class="input-group w-100 mx-auto d-flex mb-4">
                                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                                </div>
                                <div class="mb-3">
                                <h4>Categories</h4>
                                <ul class="list-unstyled fruite-categorie">
                                    <?php foreach ($category_result as $category) { ?>
                                        <li>
                                            <div class="d-flex justify-content-between fruite-name">
                                                <a href="#" class="category-filter" data-category="<?php echo $category['name']; ?>">
                                                    <i class="fas fa-apple-alt me-2"></i><?php echo $category['name']; ?>
                                                </a>
                                                <span>(<?php echo $category['product_count']; ?>)</span>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            </div>
                                <div class="d-flex justify-content-center my-4">
                                    <a href="shop.php" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">View More</a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="position-relative">
                                    <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                    <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                        <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid vesitable py-5">
              <div class="container py-5">
                    <h1 class="mb-0">Related Vegetable</h1>

        <div class="owl-carousel vegetable-carousel justify-content-center" >
            <?php foreach ($product_result as $product) { ?>
                <div class="border border-primary rounded position-relative vesitable-item">
                    <div class="vesitable-img">
                        <img src="admin/images/products/<?php echo $product['image']; ?>"
                            class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">
                        Vegetable</div>
                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                        <h4><?php echo $product['name']; ?></h4>
                        <p><?php echo $product['description']; ?></p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">$<?php echo $product['price']; ?> / kg</p>
                            <a href="" class="add-to-cart btn border border-secondary rounded-pill px-3 text-primary"
                                data-product-id="<?php echo $product['id']; ?>">
                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

        <!-- Single Product End -->
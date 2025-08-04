<!-- Fruits Shop Start-->
<html>
    <head>
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
th, td {
    text-align: center;
    vertical-align: middle;
    width: auto;
}

.pr-image{
    min-height: 250px;
    max-height: 260px;
}
    </style>
    </head>
</html>
<?php
include "db_connect.php";


$category_query = "SELECT * from category";
$category_data = mysqli_query($conn, $category_query);
$category_result = mysqli_fetch_all($category_data, MYSQLI_ASSOC);

$product_query = "SELECT products.*, category.name AS category_name 
        FROM products 
        JOIN category ON products.category_id = category.id";
$product_data = mysqli_query($conn, $product_query);
$product_result = mysqli_fetch_all($product_data, MYSQLI_ASSOC);
?>

<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-4 text-start">
                    <h1>Our Organic Products</h1>
                </div>
                <div class="col-lg-8 text-end">
                    <ul class="nav nav-pills d-inline-flex text-center mb-5">
                        <li class="nav-item">
                            <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill"
                                href="#tab-all">
                                <span class="text-dark" style="width: 130px;">All Products</span>
                            </a>
                        </li>

                        <?php foreach ($category_result as $category) { ?>
                            <li class="nav-item">
                                <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill"
                                    href="#tab-<?php echo $category['id']; ?>">
                                    <span class="text-dark" style="width: 130px;"><?php echo $category['name']; ?></span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="tab-content">
                <!-- All Products Tab -->
                <div id="tab-all" class="tab-pane fade show active p-0">
                    <div class="row g-4">
                        <?php foreach ($product_result as $product) { ?>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="rounded position-relative fruite-item">
                                    <div class="fruite-img">
                                        <img src="admin/images/products/<?php echo $product['image']; ?>"
                                            class="pr-image img-fluid w-100 rounded-top" alt="">
                                    </div>
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                        style="top: 10px; left: 10px;">
                                        <?php echo $product['category_name']; ?>
                                    </div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                        <h4><?php echo $product['name']; ?></h4>
                                        <p><?php echo $product['description']; ?></p>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-2">₹<?php echo $product['price']; ?>/kg</p>
                                             <?php echo " . ";?>
                                            <a href=""
                                                class="add-to-cart btn border border-secondary rounded-pill px-3 text-primary"
                                                data-product-id="<?php echo $product['id']; ?>">
                                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Category-wise Product Tabs -->
                <?php foreach ($category_result as $category) { ?>
                    <div id="tab-<?php echo $category['id']; ?>" class="tab-pane fade p-0">
                        <div class="row g-4">
                            <?php foreach ($product_result as $product) {
                                if ($product['category_id'] == $category['id']) { ?>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <img src="admin/images/products/<?php echo $product['image']; ?>"
                                                    class="pr-image img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                style="top: 10px; left: 10px;">
                                                <?php echo $product['category_name']; ?>
                                            </div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4><?php echo $product['name']; ?></h4>
                                                <p><?php echo $product['description']; ?></p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">₹<?php echo $product['price']; ?> / kg
                                                    </p>
                                                    <a href=""
                                                        class="add-to-cart btn border border-secondary rounded-pill px-3 text-primary"
                                                        data-product-id="<?php echo $product['id']; ?>">
                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- Fruits Shop End-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $(".add-to-cart").click(function (e) {
            e.preventDefault();
            var productId = $(this).data("product-id");

            $.ajax({
                url: "addtocart.php",
                method: "POST",
                data: { product_id: productId },
                dataType: "json", // Ensures proper JSON parsing
                success: function (response) {
                    console.log(response); // Debugging: Check response in browser console

                    if (response.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Added to Cart!",
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload(); // Reload after alert is closed
                        });
                    } else {
                        Swal.fire({
                            icon: "info",
                            title: "Already in Cart",
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error); // Debugging: Log AJAX errors
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Failed to add product to cart. Please try again!",
                    });
                }
            });
        });
    });
</script>
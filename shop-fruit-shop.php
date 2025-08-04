<?php
include "db_connect.php";
include "admin/pagination.php";

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 9; // Display 9 products per page

if ($page < 1) $page = 1;

$offset = ($page - 1) * $limit;

// Get total number of products
$total_query = "SELECT COUNT(*) as total FROM products";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total = $total_row['total'];

$num_links = 5;
$pagination = new Pagination();
$pagination->total = $total;
$pagination->num_links = $num_links;
$pagination->page = $page;
$pagination->limit = $limit;

$pagination->url = 'shop.php?page={page}';

$pagination = $pagination->render();

// Display page info
$pages = sprintf(
    "Showing %s to %s of %s (%s Pages)",
    ($total) ? (($page - 1) * $limit) + 1 : 0,
    min(($page * $limit), $total),
    $total,
    ceil($total / $limit)
);

// Fetch Categories
$category_query = "
    SELECT c.*, COUNT(p.id) AS product_count 
    FROM category c
    LEFT JOIN products p ON c.id = p.category_id
    GROUP BY c.id
";
$category_data = mysqli_query($conn, $category_query);
$category_result = mysqli_fetch_all($category_data, MYSQLI_ASSOC);

// Fetch Products with Pagination
$product_query = "SELECT * FROM products LIMIT $limit OFFSET $offset";
$product_data = mysqli_query($conn, $product_query);
$product_result = mysqli_fetch_all($product_data, MYSQLI_ASSOC);
?>
<html>

<head>
    <title>Nature Basket</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    .pagination .active span {
    background: #81c408;
    color: white;
    border-color: #81c408;
    font-weight: bold;
}
.pr-image{
    min-height: 250px;
}
</style>

<body>
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5" >
            <h1 class="text-center text-white display-6">Shop</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active text-white">Shop</li>
            </ol>
        </div>
        <!-- Single Page Header End -->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh Fruits Shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-xl-3">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" id="search-box" class="form-control p-3" placeholder="Search products..." aria-describedby="search-btn">
                                <button id="search-btn" class="input-group-text p-3"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-3">
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

                        <div class="col-lg-9">
                            <div class="row g-4 " id="product-list">
                                <?php foreach ($product_result as $product) { ?>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img" style="height: 260">
                                                <img src="admin/images/products/<?php echo $product['image']; ?>" class=" img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4><?php echo $product['name']; ?></h4>
                                                <p><?php echo $product['description']; ?></p>
                                                <p class="text-dark fs-5 fw-bold mb-0">₹<?php echo $product['price']; ?>/kg</p>
                                                <a href="#" class="add-to-cart btn border border-secondary rounded-pill px-3 text-primary" data-product-id="<?php echo $product['id']; ?>">
                                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="row">
                                    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                                    <div class="col-sm-6 text-right"><?php echo $pages; ?></div>
                                </div>  
                            </div>
                        </div>
                    </div>
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
    <script>
        $(document).ready(function () {
            $("#search-btn").click(function () {
                let query = $("#search-box").val();
                fetchProducts(query, '');
            });

            $("#search-box").on("keyup", function (e) {
                if (e.key === "Enter") {
                    let query = $(this).val();
                    fetchProducts(query, '');
                }
            });

            $(".category-filter").click(function (e) {
                e.preventDefault();
                let category = $(this).data("category");
                fetchProducts('', category);
            });

            function fetchProducts(searchQuery, category) {
                $.ajax({
                    url: "fetch_product.php",
                    method: "POST",
                    data: { search: searchQuery, category: category },
                    success: function (response) {
                        $("#product-list").html(response);
                    }
                });
            }
        });
    </script>

</body>

</html>

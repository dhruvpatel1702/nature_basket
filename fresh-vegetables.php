<!-- Vesitable Shop Start-->
<html>

<head>
    <style>
.vesitable-item {
    width: 260px; /* Fixed width for product cards */
    height: 420px; /* Fixed height for product cards */
    display: flex;
    flex-direction: column;
    border: 1px solid #ddd;
    overflow: hidden;
}

.vesitable-img {
    width: 100%;
    height: 200px; /* Fixed height for images */
    overflow: hidden; 
}

.vesitable-img img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures image covers the area properly */
}

.p-4 {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.add-to-cart {
    white-space: nowrap;
    align-self: center;
}


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

</head>

</html>
<?php
include "db_connect.php";
$product_query = "SELECT * FROM products WHERE category_id = (SELECT id FROM category WHERE name = 'Vegetable')";
$product_data = mysqli_query($conn, $product_query);
$product_result = mysqli_fetch_all($product_data, MYSQLI_ASSOC);
?>


<div class="container-fluid vesitable py-5">
    <div class="container py-5">
        <h1 class="mb-0">Fresh Organic Vegetables</h1>

        <div class="owl-carousel vegetable-carousel justify-content-center">
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
                            <p class="text-dark fs-5 fw-bold mb-0">₹<?php echo $product['price']; ?> / kg</p>
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
<!-- Vesitable Shop End -->
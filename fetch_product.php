<?php
include "db_connect.php";

$search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : '';
$category = isset($_POST['category']) ? mysqli_real_escape_string($conn, $_POST['category']) : '';

$query = "SELECT * FROM products WHERE 1";

if (!empty($search)) {
    $query .= " AND name LIKE '%$search%'";
}

if (!empty($category)) {
    $query .= " AND category_id = (SELECT id FROM category WHERE name = '$category')";
}

$result = mysqli_query($conn, $query);
$output = '';

if (mysqli_num_rows($result) > 0) {
    while ($product = mysqli_fetch_assoc($result)) {
        $output .= '
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="rounded position-relative fruite-item">
                    <div class="fruite-img">
                        <img src="admin/images/products/' . $product['image'] . '" class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                        <h4>' . $product['name'] . '</h4>
                        <p>' . $product['description'] . '</p>
                        <p class="text-dark fs-5 fw-bold mb-0">$' . $product['price'] . '/ kg</p>
                        <a href="#" class="add-to-cart btn border border-secondary rounded-pill px-3 text-primary" data-product-id="' . $product['id'] . '">
                            <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                        </a>
                    </div>
                </div>
            </div>';
    }
} else {
    $output = "<p class='text-center'>No products found.</p>";
}

echo $output;
?>

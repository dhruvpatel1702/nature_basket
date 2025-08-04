<?php
include "db_connect.php";
session_start();

if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
    $products = $_SESSION["cart"];
    
    $product_ids = array_keys($_SESSION["cart"]);

    $ids_string = implode(",", array_map('intval', $product_ids));

    $sql = "SELECT * FROM products WHERE id IN ($ids_string)";
    $result = $conn->query($sql);

    $cart_products = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $cart_products[$id] = [
                "id" => $id,
                "name" => $row["name"],
                "price" => $row["price"],
                "image" => $row["image"],
                "quantity" => $_SESSION["cart"][$id]["quantity"]
            ];
        }
    }
}
$subtotal = 0;
if (!empty($cart_products)) {
    foreach ($cart_products as $product) {
        $subtotal += $product['price'] * $product['quantity'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <?php include('include/style.php'); ?>
</head>

<body>

    <!-- Spinner Start -->
    
    

    <!-- Spinner End -->

    <?php include('include/header.php'); ?>

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5"style="margin-top: 129px;">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Cart Page Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            
                <?php if (isset($cart_products)) { ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Products</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart_products as $product) { ?>
                                <tr data-id="<?php echo $product['id']; ?>">
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="admin/images/products/<?php echo $product['image']; ?>"
                                                class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4"><?php echo $product['name']; ?></p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4 product-price">₹<?php echo $product['price']; ?></p>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control form-control-sm text-center border-0"
                                                value="<?php echo $product['quantity']; ?>" style="background-color:#ffffff;"
                                                readonly>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4 product-total">
                                        ₹<?php echo number_format($product['price'] * $product['quantity'],2); ?></p>
                                    </td>
                                    <td>
                                        <button class="btn btn-remove btn-md rounded-circle bg-light border mt-4">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                
                <!-- <div class="mt-5">
                <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply
                    Coupon</button>
                  </div>-->
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Subtotal:</h5>
                                    <p class="mb-0 cart-subtotal">₹<?php echo number_format($subtotal,2); ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0 me-4">Shipping</h5>
                                    <div class="">
                                        <p class="mb-0">Flat rate: ₹3.00</p>
                                    </div>
                                </div>
                                <p class="mb-0 text-end">Shipping to India.</p>
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Total</h5>
                                <p class="mb-0 pe-4 cart-total">₹<?php echo number_format($subtotal + 3 ,2); ?></p>
                            </div>
                            <button onclick="redirectToCheckout()"
                                class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                                type="button">Proceed Checkout</button>
                        </div>
                    </div>
                </div>
             <?php } else { ?>
                <div id="empty-cart-message" class="text-center mt-4">
                    <h3>Your cart is empty!</h3>
                    <a href="shop.php" class="btn btn-primary">Go Shopping</a>
                </div>

                <?php
                } ?>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->
    <?php include('include/footer.php'); ?>
    <?php include('include/script.php'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updateCartSummary() {
    let subtotal = 0;

    $(".product-total").each(function () {
        const value = parseFloat($(this).text().replace("₹", ""));
        if (!isNaN(value)) {
            subtotal += value;
        }
    });

    const shipping = 3.00;
    const total = (subtotal + shipping).toFixed(2);
    subtotal = subtotal.toFixed(2);

    $(".cart-subtotal").text("₹" + subtotal);
    $(".cart-total").text("₹" + total);
}


        function redirectToCheckout() {
    var isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    
    if (!isLoggedIn) {
        window.location.href = 'user/form.php'; // Redirect to login page
    } else {
        window.location.href = 'checkout.php'; // Proceed to checkout
    }
}
        $(document).ready(function () {
            $(".btn-plus, .btn-minus").click(function () {
                var button = $(this);
                var input = button.closest(".quantity").find("input");
                var productId = button.closest("tr").data("id");
                var action = button.hasClass("btn-plus") ? "plus" : "minus";

                $.ajax({
                    url: "update_cart.php",
                    method: "POST",
                    data: { product_id: productId, action: action },
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            input.val(response.new_quantity);
                            updateTotal(button.closest("tr"));
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });

            function updateTotal(row) {
                var price = parseFloat(row.find(".product-price").text().replace("₹", ""));
                var quantity = parseInt(row.find("input").val());
                var total = (price * quantity).toFixed(2); // Ensures two decimal places
                row.find(".product-total").text("₹" + total);
                updateCartSummary(); // 🔄 update subtotal + total
            }
            $(".btn-remove").click(function () {
                var button = $(this);
                var productId = button.closest("tr").data("id");

                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to remove this product from the cart?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, remove it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "remove_cart.php",
                            method: "POST",
                            data: { product_id: productId },
                            dataType: "json",
                            success: function (response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Removed!",
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        location.reload(); // Reload after alert is closed
                                    });

                                    button.closest("tr").remove(); // Remove row from table
                                } else {
                                    Swal.fire("Error!", response.message, "error");
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
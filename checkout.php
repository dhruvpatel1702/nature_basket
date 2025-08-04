<?php
// Include this at the top
include "db_connect.php";
session_start();

$products = [];

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
$shipping_charge = 3;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('include/style.php'); ?>
</head>

<body>
    <?php include('include/header.php'); ?>

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Checkout</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            
            <li class="breadcrumb-item active text-white">Checkout</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <?php if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) { ?>
            <h1 class="mb-4">Billing details</h1>
            <form action="order_store.php" method="post" id="checkoutForm">
                <div class="row g-5">
                    <div class="col-md-12 col-lg-6 col-xl-7">
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">First Name<sup>*</sup></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="form-item w-100">
                                    <label class="form-label my-3">Last Name<sup>*</sup></label>
                                    <input type="text" class="form-control" name="last_name" id="last_name">
                                </div>
                            </div>
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Address <sup>*</sup></label>
                            <input type="text" class="form-control" name="address" id="address"
                                placeholder="House Number Street Name">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Town/City<sup>*</sup></label>
                            <input type="text" class="form-control" name="city" id="city">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Country<sup>*</sup></label>
                            <input type="text" class="form-control" name="country" id="country">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                            <input type="text" class="form-control" name="postcode" id="postcode">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Mobile<sup>*</sup></label>
                            <input type="text" class="form-control" name="mobile" id="mobile">
                        </div>
                        <div class="form-item">
                            <label class="form-label my-3">Email Address<sup>*</sup></label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                    </div>
     
                    <div class="col-md-12 col-lg-6 col-xl-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Products</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($cart_products)) {
                                        foreach ($cart_products as $product) { ?>
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center mt-2">
                                                        <img src="admin/images/products/<?php echo $product['image']; ?>"
                                                            class="img-fluid rounded-circle" style="width: 90px; height: 90px;"
                                                            alt="">
                                                    </div>
                                                </th>
                                                <td class="py-5"><?php echo $product['name']; ?></td>
                                                <td class="py-5">₹<?php echo $product['price']; ?></td>
                                                <td class="py-5"><?php echo $product['quantity']; ?></td>
                                                <td class="py-5">
                                                ₹<?php echo number_format($product['price'] * $product['quantity'], 2); ?>
                                                </td>
                                            </tr>
                                        <?php }
                                    } ?>
                                    <tr>
                                        <th scope="row">
                                        </th>
                                        <td class="py-5"></td>
                                        <td class="py-5"></td>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark py-3">Subtotal</p>
                                        </td>
                                        <td class="py-5">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark">₹<?php echo number_format($subtotal, 2); ?>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                        </th>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark py-4">Shipping</p>
                                        </td>
                                        <td colspan="3" class="py-5">
                                            <!-- <div class="form-check text-start">
                                                <input type="checkbox" class="form-check-input bg-primary border-0"
                                                    id="Shipping-3" name="Shipping-1" value="Shipping">
                                                <label class="form-check-label" for="Shipping-3">Local Pickup:
                                                    $8.00</label>
                                            </div> -->
                                            <div class="form-check text-start">
                                                <label class="form-check-label" for="Shipping-2">Flat rate:
                                                    ₹<?php echo $shipping_charge; ?></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                        </th>
                                        <td class="py-5">
                                            <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                        </td>
                                        <td class="py-5"></td>
                                        <td class="py-5"></td>
                                        <td class="py-5">
                                            <div class="py-3 border-bottom border-top">
                                                <p class="mb-0 text-dark" id="cart-total">
                                                ₹<?php echo number_format($subtotal + $shipping_charge, 2); ?></p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="delivery"
                                        name="Delivery" value="Delivery">
                                    <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                            <div class="col-12">
                                <div class="form-check text-start my-3">
                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="razorpay"
                                        name="Paypal" value="Paypal">
                                    <label class="form-check-label" for="Paypal-1">Razorpay</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                            <?php if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){ ?>
                            <button
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary razorpay-btn"
                                id="rzp-button1" type="button">Place Order</button>
                                <?php }else{?>
                            <a
                                class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary" href="user/form.php">Login</a>
                                <?php  } ?>
                        </div>
                    </div>
                </div>
            </form>
            <?php } else{ ?>
                <div id="empty-cart-message" class="text-center mt-4">
                <h3>Your cart is empty!</h3>
                <a href="shop.php" class="btn btn-primary">Go Shopping</a>
            </div>
          <?php  } ?>
        </div>
    </div>
    <!-- Checkout Page End -->
    <!-- footer start -->
    <div id="loading-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:9999; text-align:center;">
        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); font-size:20px; color:#333;">
        <img src="admin/images/kOnzy.gif" alt="Loading..." width="50" height="50" style="margin-top:10px;" />
        Processing your order...
        <br>
    </div>
</div>

    <?php include('include/footer.php'); ?>
    <?php include('include/script.php'); ?>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

        $(document).ready(function () {

            $('#delivery, #razorpay').change(function () {
                if ($(this).is(':checked')) {
                    $('#delivery, #razorpay').not(this).prop('checked', false);
                }
            });
            $('#rzp-button1').click(function (e) {
                e.preventDefault();

                let isValid = validateForm(); // Run validation
                if (!isValid) return; // Stop if validation fails

                if (!$('#razorpay').is(':checked') && !$('#delivery').is(':checked')) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Payment Method Required',
                        text: 'Please select a payment method to proceed with your order.',
                    });
                    return;
                }

                // If Razorpay is selected, open payment gateway
                if ($('#razorpay').is(':checked')) {

                    var order_price = <?php echo floatval($subtotal + $shipping_charge); ?>;

                    var first_name = $('#first_name').val();
                    var last_name = $('#last_name').val();
                    var address = $('#address').val();
                    var city = $('#city').val();
                    var country = $('#country').val();
                    var mobile = $('#mobile').val();
                    var pincode = $('#postcode').val();
                    var email = $('#email').val();
                    $.ajax({
                        url: "order.php", // Your backend script to create an order
                        type: "POST",
                        data: {
                            order_price: order_price,
                            first_name: first_name,
                            last_name: last_name,
                            address: address,
                            city: city,
                            country: country,
                            mobile: mobile,
                            pincode: pincode,
                            email: email
                        },
                        dataType: "json",
                        beforeSend: function () {
                            $('#loading-overlay').show();
                        },
                        success: function (response) {
                            if (response.order_id) {
                                var options = {
                                    "key": "rzp_test_XJEyStQjYGbyFu",
                                    "amount": order_price , // Convert rupees to paise
                                    "currency": "INR",
                                    "name": "Nature Basket",
                                    "description": "Order Payment",
                                    "image": "https://yourwebsite.com/logo.png",
                                    "order_id": response.order_id, // Dynamically assigned order_id
                                    "handler": function (response) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Payment Successful!',
                                            text: 'Your payment has been processed successfully.',
                                        }).then(() => {
                                            window.location.href = "success_order.php?payment_id=" + response.razorpay_payment_id;
                                        });
                                    },
                                    "prefill": {
                                        "name": "Customer Name",
                                        "email": "customer@example.com",
                                        "contact": "9999999999"
                                    },
                                    "theme": {
                                        "color": "#3399cc"
                                    }
                                };

                                var rzp1 = new Razorpay(options);
                                rzp1.open();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Payment Error',
                                    text: 'Error creating Razorpay order. Please try again.',
                                });
                            }
                        },
                        complete: function () {
                                $('#loading-overlay').hide();
                            },
                        error: function (error) {
                            console.log("AJAX Error:", error);
                            alert("Failed to create order.");
                        }
                    });
                } else {

                    var order_price = <?php echo floatval($subtotal + $shipping_charge); ?>;

                    var first_name = $('#first_name').val();
                    var last_name = $('#last_name').val();
                    var address = $('#address').val();
                    var city = $('#city').val();
                    var country = $('#country').val();
                    var mobile = $('#mobile').val();
                    var pincode = $('#postcode').val();
                    var email = $('#email').val();
                    $.ajax({
                        url: "order_store.php", // Your backend script to create an order
                        type: "POST",
                        data: {
                            order_price: order_price,
                            first_name: first_name,
                            last_name: last_name,
                            address: address,
                            city: city,
                            country: country,
                            mobile: mobile,
                            pincode: pincode,
                            email: email
                        },
                        dataType: "json",
                        beforeSend: function () {
                            $('#loading-overlay').show();
                        },
                        success: function (response) {
                            if (response) {
                                // If Cash on Delivery is selected, show confirmation
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Order Placed',
                                    text: 'Your Cash on Delivery order has been placed successfully!',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "success_order.php?cod=true";
                                    }
                                });
                            }
                        },
                        complete: function () {
                                $('#loading-overlay').hide();
                            },
                        error: function (error) {
                            console.log("AJAX Error:", error);
                            alert("Failed to create order.");
                        }
                    });
                }
            });
        });
        function validateForm() {
            let isValid = true;

            // Get form fields
            let firstName = document.getElementById("first_name");
            let lastName = document.getElementById("last_name");
            let address = document.getElementById("address");
            let city = document.getElementById("city");
            let country = document.getElementById("country");
            let postcode = document.getElementById("postcode");
            let mobile = document.getElementById("mobile");
            let email = document.getElementById("email");

            // Reset previous error messages
            document.querySelectorAll(".error-message").forEach(el => el.remove());

            function showError(input, message) {
                isValid = false;
                let error = document.createElement("small");
                error.classList.add("error-message", "text-danger");
                error.innerText = message;
                input.classList.add("border-danger");
                input.parentNode.appendChild(error);
            }

            function removeError(input) {
                input.classList.remove("border-danger");
            }

            function isEmailValid(email) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            }

            function isNumeric(value) {
                return /^\d+$/.test(value);
            }

            // Validate each field
            if (firstName.value.trim() === "") showError(firstName, "First name is required");
            else removeError(firstName);
            
            if (lastName.value.trim() === "") showError(lastName, "Last name is required");
            else removeError(lastName);

            if (address.value.trim() === "") showError(address, "Address is required");
            else removeError(address);

            if (city.value.trim() === "") showError(city, "City is required");
            else removeError(city);

            if (country.value.trim() === "") showError(country, "Country is required");
            else removeError(country);

            if (postcode.value.trim() === "") showError(postcode, "Postcode is required");
            else if (!isNumeric(postcode.value)) showError(postcode, "Postcode must be numbers only");
            else removeError(postcode);

            if (mobile.value.trim() === "") showError(mobile, "Mobile number is required");
            else if (!isNumeric(mobile.value) || mobile.value.length < 10 || mobile.value.length > 15)
                showError(mobile, "Enter a valid mobile number (10-15 digits)");
            else removeError(mobile);

            if (email.value.trim() === "") showError(email, "Email is required");
            else if (!isEmailValid(email.value)) showError(email, "Enter a valid email");
            else removeError(email);

            return isValid;
        }

        // Remove errors when the user starts typing
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("#checkoutForm input").forEach(input => {
                input.addEventListener("input", function () {
                    this.classList.remove("border-danger");
                    let error = this.parentNode.querySelector(".error-message");
                    if (error) {
                        error.remove();
                    }
                });
            });
        });

    </script>
    <!-- footer end -->
    <script>
        $(document).ready(function () {
            $("#Shipping-3").change(function () {
                let subtotal = <?php echo $subtotal; ?>;
                let shippingCharge = $(this).is(":checked") ? -8 : 3; // Minus 8 if checked, else flat rate 3
                let total = subtotal + shippingCharge;

                $("#cart-total").text("₹" + total.toFixed(2));
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("checkoutForm").addEventListener("submit", function (event) {
                event.preventDefault(); // Prevent form submission until validation passes

                let isValid = true;

                // Get form fields
                let firstName = document.getElementById("first_name");
                let lastName = document.getElementById("last_name");
                let address = document.getElementById("address");
                let city = document.getElementById("city");
                let country = document.getElementById("country");
                let postcode = document.getElementById("postcode");
                let mobile = document.getElementById("mobile");
                let email = document.getElementById("email");

                // Reset previous error messages
                document.querySelectorAll(".error-message").forEach(el => el.remove());

                // Validation functions
                function showError(input, message) {
                    isValid = false;
                    let error = document.createElement("small");
                    error.classList.add("error-message", "text-danger");
                    error.innerText = message;
                    input.classList.add("border-danger");
                    input.parentNode.appendChild(error);
                }

                function removeError(input) {
                    input.classList.remove("border-danger");
                }

                function isEmailValid(email) {
                    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                }

                function isNumeric(value) {
                    return /^\d+$/.test(value);
                }

                
        
                // Validate each field
                if (firstName.value.trim() === "") showError(firstName, "First name is required");
                else removeError(firstName);

                if (lastName.value.trim() === "") showError(lastName, "Last name is required");
                else removeError(lastName);

                if (address.value.trim() === "") showError(address, "Address is required");
                else removeError(address);

                if (city.value.trim() === "") showError(city, "City is required");
                else removeError(city);

                if (country.value.trim() === "") showError(country, "Country is required");
                else removeError(country);

                if (postcode.value.trim() === "") showError(postcode, "Postcode is required");
                else if (!isNumeric(postcode.value)) showError(postcode, "Postcode must be numbers only");
                else removeError(postcode);

                if (mobile.value.trim() === "") showError(mobile, "Mobile number is required");
                else if (!isNumeric(mobile.value) || mobile.value.length < 10 || mobile.value.length > 15)
                    showError(mobile, "Enter a valid mobile number (10 digits)");
                else removeError(mobile);

                if (email.value.trim() === "") showError(email, "Email is required");
                else if (!isEmailValid(email.value)) showError(email, "Enter a valid email");
                else removeError(email);

                // If all validations pass, submit the form
                if (isValid) {
                    this.submit();
                }
            });
            document.querySelectorAll("#checkoutForm input").forEach(input => {
                input.addEventListener("input", function () {
                    this.classList.remove("border-danger");
                    let error = this.parentNode.querySelector(".error-message");
                    if (error) {
                        error.remove();
                    }
                });
            });
        });

    </script>
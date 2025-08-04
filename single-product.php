<?php
include "db_connect.php";

$category_query = "
    SELECT c.*, COUNT(p.id) AS product_count 
    FROM category c
    LEFT JOIN products p ON c.id = p.category_id
    GROUP BY c.id ";

$category_data = mysqli_query($conn, $category_query);
$category_result = mysqli_fetch_all($category_data, MYSQLI_ASSOC);

$product_query = "SELECT * FROM products WHERE category_id = (SELECT id FROM category WHERE name = 'Vegetable')";
$product_data = mysqli_query($conn, $product_query);
$product_result = mysqli_fetch_all($product_data, MYSQLI_ASSOC);

$reply_query ="SELECT * FROM reply";
$reply_data =mysqli_query($conn, $reply_query);
$reply_result = mysqli_fetch_all( $reply_data, MYSQLI_ASSOC);

//seve reply in testimonial

if($_SERVER["REQUEST_METHOD"] == "POST") {
 //GET form data and prevent SQL injection
 $name = $conn->real_escape_string($_POST['name']);
 $email =$conn->real_escape_string($_POST['email']);
 $message =$conn->real_escape_string($_POST['message']);
 $rating = isset($_POST['rating']) ?   (int)$_POST['rating'] : 0 ;

 // insert data into the reply table
 $sql = "INSERT INTO reply (name, email, message,rating) VALUES ('$name', '$email', '$message','$rating')";

 if ($conn->query($sql) === TRUE) {
     
 } else {
     echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
 }
 $conn->close(); // Close connection
  // Stop further execution
}


?>
<html>
    <style>
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
        .chenge-w{
            width: 100% !important;
        }
    </style>
    </style>
</html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop-detail</title>

    <?php include('include/style.php'); ?>
</head>
        <!-- Single Product Start -->
        <div class="container-fluid testimonial py-5">
            <div class="container py-5">
                <div class="row g-4 mb-5">
                    <div class="col-lg-8 col-xl-9 chenge-w">
                        <div class="row g-4">
                           <?php include'single-shop-product.php'; ?>
                            <div class="col-lg-12">
                                <nav>
                                    <div class="nav nav-tabs mb-3">
                                        <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                            id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                            aria-controls="nav-about" aria-selected="true">Description</button>
                                        <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                            id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                            aria-controls="nav-mission" aria-selected="false">Reviews</button>
                                    </div>
                                </nav>
                                <div class="tab-content mb-5">
                                    <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                        <p>There are more than 8,000 varieties of grape. Grapes grow in wooded and warm regions of the world.</p>
                                        
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
                                    <!-- review Start  !-->
                                    <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                        <?php foreach($reply_result as $reply){ ?>
                                        <div class="d-flex">
                                            
                                            <div class="">
                                                <p class="mb-2" style="font-size: 14px;"><?php echo $reply['created_at']; ?></p>
                                                <div class="d-flex justify-content-between">
                                                    <h5><?php echo $reply['name'];?></h5>
                                                    <div class="d-flex mb-3">
                                                        <?php for($i=0; $i< $reply['rating']; $i++){ ?>
                                                         <i class="fas fa-star text-primary"></i>
                                                         <?php } ?>
                                                        </div>
                                                </div>
                                                <p><?php echo $reply['message']; ?></p>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div><!-- review End !-->
                                    <!--
                                    <div class="tab-pane" id="nav-vision" role="tabpanel">
                                        <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                            amet diam et eos labore. 3</p>
                                        <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                            Clita erat ipsum et lorem et sit</p>
                                    </div> !-->
                                </div>
                            </div>
                            <!-- reply start !-->
                            <form  method="post" id="replyForm">
                                <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="border-bottom rounded">
                                            <input type="text" class="form-control border-0 me-4" name ="name" id="name"placeholder="your Name *">
                                            <label id="name-error" class="error text-danger" for="name"></label>
                            
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="border-bottom rounded">
                                            <input type="email" name="email" class="form-control border-0" placeholder="Your Email *" id="email" value="<?php echo $_SESSION['user_email']?? '';?>">
                                            <label id="email-error" class="error text-danger" for="email"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="border-bottom rounded my-4">
                                            <textarea name="message" id="message" class="form-control border-0" cols="30" rows="8" placeholder="Your Review *" spellcheck="false"></textarea>
                                            <label id="message-error" class="error text-danger" for="message"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between py-3 mb-5">
                                            <div class="d-flex align-items-center">
                                                <p class="mb-1 me-2">Please rate:</p>
                                                <div class="d-flex align-items-center"  id="rating-stars"     style="font-size: 12px;">
                                                    <i class="fa fa-star text-muted" data-value="1"></i>
                                                    <i class="fa fa-star text-muted" data-value="2"></i>
                                                    <i class="fa fa-star text-muted" data-value="3"></i>
                                                    <i class="fa fa-star text-muted" data-value="4"></i>
                                                    <i class="fa fa-star text-muted" data-value="5"></i>
                                                </div>
                                                <input type="hidden" name="rating" id="rating-value">
                                            </div>
                                            <button href="#" type="submit" class="btn border border-secondary text-primary rounded-pill px-4 py-3"> Post Comment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- reply end !-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
    <div class="container py-5">
        <h1 class="mb-11">Related Products</h1>

        <div class="owl-carousel vegetable-carousel justify-content-center ">
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
                            <p class="text-dark fs-5 fw-bold mb-0">₹<?php echo $product['price']; ?>/kg</p>
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


<!-- SweetAlert & jQuery Validate -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
$(document).ready(function () {
    $("#replyForm").validate({
        errorClass: "text-danger", // Error styling
        rules: {
            name: { required: true, minlength: 3 },
            email: { required: true, email: true },
            message: { required: true, minlength: 10 }
        },
        messages: {
            name: { required: "Please enter your name", minlength: "Name must be at least 3 characters long" },
            email: { required: "Please enter your email", email: "Please enter a valid email address" },
            message: { required: "Please enter your message", minlength: "Message must be at least 10 characters long" }
        },
        submitHandler: function (form) {
            $.ajax({
                url: window.location.href, // Use the same PHP file
                type: "POST",
                data: $("#contactForm").serialize(),
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            $("#replyForm")[0].reset(); // Reset form
                        });
                    } else {
                        Swal.fire("Error!", response.message, "error");
                    }
                },
                error: function () {
                    Swal.fire("Error!", "Something went wrong. Please try again.", "error");
                }
            });
        }
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll("#rating-stars i");
    const ratingValue = document.getElementById("rating-value");

    stars.forEach((star, index) => {
        star.addEventListener("click", function () {
            let selectedRating = index + 1;
            ratingValue.value = selectedRating;

            // Reset all stars to muted
            stars.forEach(s => s.classList.remove("text-warning"));
            stars.forEach(s => s.classList.add("text-muted"));

            // Highlight selected stars
            for (let i = 0; i < selectedRating; i++) {
                stars[i].classList.remove("text-muted");
                stars[i].classList.add("text-warning");
            }
        });
    });
});
</script>


        <!-- Single Product End -->
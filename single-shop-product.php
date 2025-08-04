<?php
include "db_connect.php";

$banner_query = "SELECT banner.*, products.id,products.price, products.description,products.category_id
                 FROM banner 
                 LEFT JOIN products ON banner.product_id = products.id";
$banner_data = mysqli_query($conn, $banner_query);
$banner_result = mysqli_fetch_all($banner_data, MYSQLI_ASSOC);


?>


<?php  foreach($banner_result as $banner){?>
                            <div class="col-lg-6">
                                <div class="border rounded">
                                    <a href="#">
                                        <img src="admin/images/banner/<?php  echo $banner['image']; ?>" class="img-fluid rounded" alt="Image" style="height: 371px;width:544px;">
                                    </a>
                                </div>
                             </div>
                             <?php
                             $category_n = "SELECT * From category where id=".$banner['category_id'];
                             $category_d = mysqli_query($conn, $category_n);
                                $category_name_result = mysqli_fetch_assoc($category_d);
                             ?>
                             <div class="col-lg-6">
                                <h4 class="fw-bold mb-3"><?php echo $banner['banner_name'];?></h4>
                                <p class="mb-3">Category: <?php  echo $category_name_result['name']; ?></p>
                                <h5 class="fw-bold mb-3">₹<?php echo $banner['price']; ?></h5>
                                
                                
                                
                                <p class="mb-4"><?php  echo $banner['description']; ?></p>
                                <!--<div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" value="1">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>!-->
                                <?php echo "<br>";?>
                                <a href="" class="add-to-cart btn border border-secondary rounded-pill px-3 text-primary"
                                data-product-id="<?php echo $banner['id']; ?>">
                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart
                            </a>
                            </div>
                            <?php }?>

                            
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
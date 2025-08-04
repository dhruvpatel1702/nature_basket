<?php

include "db_connect.php";


$testimonial_query = "SELECT * FROM testimonial";
$testimonial_data = mysqli_query($conn, $testimonial_query);
$testimonial_result = mysqli_fetch_all($testimonial_data, MYSQLI_ASSOC);
?>
<?php


if(isset($_GET['testimonial_id']) && $_GET['testimonial_id']){
    $testimonial_id = $_GET['testimonial_id'];
    $testimonial_data = "SELECT * FROM testimonial WHERE id =".$testimonial_id;
    $testimonial_result = mysqli_query($conn, $testimonial_data);
    
    if ($testimonial_result && mysqli_num_rows($testimonial_result) > 0) {
        $testimonial_edit = mysqli_fetch_assoc($testimonial_result);
        $image = $testimonial_edit['image']; // Assign existing image from DB
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $designation = $_POST["designation"];
    $description = $_POST["description"];
    $star =$_POST['star'];
    
    // Check if a new image is uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
        $target_dir = "admin/images/testimonial/";
        $target_file = $target_dir . time() . "_" . basename($_FILES["image"]["name"]);
        $image_name = time() . "_" . basename($_FILES["image"]["name"]);
        $image = $image_name; // Assign new image name
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "Image uploaded successfully! File path: " . $target_file;
        } else {
            echo "Image upload failed!";
        }
    }
    if(isset($_POST['testimonial_id']) && $testimonial_id){
        $insert_query = "UPDATE testimonial 
        SET name = '$name', 
            designation = '$designation', 
            description = '$description', 
            star = '$star', 
            image = '$image' 
        WHERE id = '$testimonial_id'";
       
       
    }else {
        $insert_query = "INSERT INTO testimonial (name,  image, designation, description,star) 
                    VALUES ('$name',  '$image', '$designation','$description','$star')";
    }
    
    if (mysqli_query($conn, $insert_query)) {       
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}

?>



<!DOCTYPE html>
       <html lang="en">
       <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Testimonials</title>
        <?php include('include/style.php');?>
       </head>
       <body>
        <?php include('include/header.php');?>
        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">testimonial</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active text-white">testimonial</li>
            </ol>
        </div>
        <!-- Single Page Header End -->

        <!-- Tastimonial Start -->
        <div class="container-fluid testimonial py-5">
            <div class="container py-5">
                <div class="testimonial-header text-center">
                    <h4 class="text-primary">Our Testimonial</h4>
                    <h1 class="display-5 mb-5 text-dark">Our Client Saying!</h1>
                    <!--<i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>!-->
                </div>
                <div class="owl-carousel testimonial-carousel">
                  
                  <?php foreach ($testimonial_result as $testimonial) { ?>
                    
                    <div class="testimonial-item img-border-radius bg-light rounded p-4" style="width: 545.5px; margin-right: 25px;">

                        
                        <div class="position-relative">
                        
                            <div class="mb-4 pb-4 border-bottom border-secondary";>
                                <p class="mb-0"><?php echo $testimonial['description']   ?></p>
                            </div>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="bg-secondary rounded">
                                    <img src="admin/images/testimonial/<?php echo $testimonial['image']; ?>" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                                </div>
                                <div class="ms-4 d-block">
                                    <h4 class="text-dark"><?php echo $testimonial['name'];?></h4>
                                    <p class="m-0 pb-3"><?php echo $testimonial['designation'];?></p>
                                    <div class="d-flex pe-5">
                                        <?PHP for($i=0; $i< $testimonial['star']; $i++) {  ?>
                                        <i class="fas fa-star text-primary"></i>
                                        <?php } ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- Tastimonial End -->

        <section class="content">
                    <div class="container-fluid" >
                      <div class="container" style="margin: top 100px;">
                        <div class="confirmation-container">
                            <div class="feedback-container">
                              <h4 class="mb-5 fw-bold" >Rate Your Experience</h4>

                                <div class="card-body">
                                    <!-- Laravel form open -->
                                    <form method="POST" action="" id="testimonialForm" enctype="multipart/form-data">
                                        <!-- Name -->
                                         <input type="hidden" name="testimonial_id"  value="<?php echo $testimonial_id; ?>">
                                        <div class="form-group">
                                            
                                            <input type="text" id="name" name="name" placeholder=" Your Name"class="form-control" value="<?php echo  $testimonial_edit['name'] ?? null; ?>">
                                        </div>

                                        <div class="form-group">
                                        <label for="designation"></label>
                                            <textarea type="text" id="designation"  placeholder="Designation"name="designation" class="form-control"><?php echo $testimonial_edit['designation'] ?? null; ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="description"></label>
                                            <textarea type="text" id="description" placeholder="description"name="description" class="form-control"><?php echo $testimonial_edit['description'] ?? null; ?></textarea>
                                        </div>
                                        <!-- URL -->
                                        <div class="form-group">
                                            <label for="url"></label>
                                            <input type="file" id="image" name="image" class="form-control" value="">
                                            <?php if(isset($testimonial_edit['image'])){ ?>
                                            <a href="images/testimonial/<?php echo $testimonial_edit['image']; ?>" target="_blank"><img src="images/testimonial/<?php echo $testimonial_edit['image']; ?>" alt="" width="100px" height="100px"></a>
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="star"></label>
                                            <input type="number" id="star" name="star" placeholder="star"
                                            class="form-control" value="<?php echo $testimonial_edit['star'] ?? null; ?>">
                                        </div>                                        

                                        <!-- Submit Button -->
                                        <div class="form-group">
                                            
                                            <input type="submit" name="submit" value="Submit" class="btn btn-primary" style="margin: 10px;" >
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </section>            

         <!-- footer start -->
         <?php include('include/footer.php');?>
        <?php include('include/script.php'); ?>
        <!-- footer end -->
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
                data: $("#replayForm").serialize(),
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
         
        </body>
        </html>
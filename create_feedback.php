<?php
include "db_connect.php";
session_start();

if(!isset($_SESSION['user']) && !isset($_SESSION['token'])){
  header("Location: admin-login.php");
  exit();
}

$image = ""; // Initialize $image to avoid undefined variable error

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
    <title>Order Confirmation</title>
    <?php include('include/style.php'); ?>

</head>


<body class="hold-transition sidebar-mini layout-fixed">
<?php include('include/header.php');?>
    
<div class="container-fluid" >
        <div class="container" style="margin-top:200px;">
            <div class="confirmation-container">
               <div class="feedback-container">
                
               
               <!-- Main content -->
                <section class="content">
                    <div class="container-fluid" >
                      <div class="container" style="margin-top:200px;">
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
                                        <label for="description"></label>
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
            </div>
        </div>
    </div>
</div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            var isEdit = Boolean("<?= isset($testimonial_edit['image']) ? 1 : 0 ?>"); // Check if editing

            $("#testimonialForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    category_id: {
                        required: true
                    },
                    image: {
                        required: isEdit ? false : true 
                    },
                    description: {
                        required: true,
                        minlength: 5
                    },
                    price: {  // Corrected field name
                        required: true,
                        number: true,  // Ensures the input is a valid number
                        min: 1  
                    }
                },
                messages: {
                    name: {
                        required: "Please enter testimonial name",
                        minlength: "testimonial Name must be at least 3 characters long"
                    },
                    designation: {
                        required: "Please select your designation"
                    },
                    image: {
                        required: "Please upload image"
                    },
                    description: {
                        required: "Please enter description",
                        minlength: "description must be at least 5 characters long"
                    },
                    star: { 
                        required: "Please enter the star",
                    }
                },
                errorPlacement: function (error, element) {
                    error.addClass("text-danger");
                    error.insertAfter(element);
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
    <?php include('include/footer.php'); ?>
    <?php include('include/script.php'); ?>
</body>
</html>
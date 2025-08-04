<?php
include "db_connect.php";
session_start();

$user_query = "SELECT * FROM users WHERE email = '" . mysqli_real_escape_string($conn, $_SESSION['user_email']) . "'";
$user_result = mysqli_query($conn, $user_query);
$user_data = mysqli_fetch_assoc($user_result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and prevent SQL injection
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);




    $update_query = "UPDATE users SET name = '$name', phone = '$phone' WHERE email = '$email'";


    if ($conn->query($update_query) === TRUE) {
        echo "<script>
        alert('Your Profile has been successfully Updated!');
        window.location.href = 'profile.php';
      </script>";     
} else {
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Database error: ' . $conn->error . '"
        });
    </script>';
    exit(); // Stop further execution
    }

    $conn->close(); // Close connection
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nature Basket</title>
    <?php include('include/style.php'); ?>
    <style>
        .center {
            place-items: center;

        }
    </style>
</head>


<body>
    <?php include('include/header.php'); ?>
    
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Your Profile</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active text-white">Your Profile</li>
        </ol>
    </div>
    <!-- Contact Start -->
    <div class="container-fluid vesitable py-5">
    <div class="container py-5">
            
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">Your Profile</h1>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <form method="POST" action="" id="profileform">
                            <input type="text" class="form-control" name="name" id="name"
                                placeholder="Your Name" value="<?php echo $user_data['name'] ?? ''; ?>">
                            <label id="name-error" class="error text-danger" for="name"></label>
                            <div class="mb-4"></div>

                            <input type="text" class="form-control" name="email" id="email"
                                placeholder="xyz@gmail.com" value="<?php echo $user_data['email'] ?? ''; ?>">
                            <label id="email-error" class="error text-danger" for="email"></label>
                            <div class="mb-4"></div>

                            <input type="text" class="form-control" name="phone" id="phone"
                                placeholder="Your Phone Number" value="<?php echo $user_data['phone'] ?? null;?>">
                            <label id="number-error" class="error text-danger" for="phone"></label>
                            <div class="mb-4"></div>
                        </div>
                        <button type="submit" class="w-100 btn form-control border-secondary py-3 bg-white    text-primary">Submit
                           </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include('include/footer.php')?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#profileform").validate({  // Corrected form ID to match the HTML
                rules: {
                    name: { required: true, minlength: 3 },
                    email: { required: true, email: true },
                    phone: { required: true, maxlength: 10 }, // Correct the validation here as well
                },
                messages: {
                    name: { required: "Please enter your name", minlength: "Name must be at least 3 characters long" },
                    email: { required: "Please enter your email", email: "Please enter a valid email address" },
                    phone: { required: "Please enter your phone number", maxlength: "Phone number must not exceed 10 digits" },
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
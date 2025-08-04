<?php
include "db_connect.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and prevent SQL injection
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);
    $location = $conn->real_escape_string($_POST['location']);



    // Insert data into the contact table
    $insert_query = "INSERT INTO contact (name, email, message, location) 
                    VALUES ('$name', '$email', '$message', '$location')";

    if ($conn->query($insert_query) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Your message has been sent successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Database error: " . $conn->error]);
    }

    $conn->close(); // Close connection
    exit(); // Stop further execution
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <?php include('include/style.php'); ?>
</head>


<body>
    <?php include('include/header.php'); ?>

    <!-- Single Page Header Start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Contact</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            
            <li class="breadcrumb-item active text-white">Contact</li>
        </ol>   
    </div>
    <!-- Single Page Header End -->

    <!-- Contact Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">Get in touch</h1>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <form method="post" id="contactForm">
                            <div class="col-lg-12">
                                <div class="rounded" style="height: 100px;">
                                    <div class="input-group">
                                        <input type="text" id="location" name="location" class="form-control"
                                            placeholder="Enter your location">

                                        <button type="button" class="btn btn-primary" onclick="getLocation()">Use My
                                            Location</button>

                                    </div>
                                </div>
                            </div>

                            <input type="text" class="w-100 form-control border-0 py-3" name="name" id="name"
                                placeholder="Your Name">
                            <label id="name-error" class="error text-danger" for="name"></label>
                            <div class="mb-4"></div>

                            <input type="email" name="email" class="w-100 form-control border-0 py-3"
                                placeholder="xyz@gmail.com" id="email"
                                value="<?php echo $_SESSION['user_email'] ?? ''; ?>">
                            <label id="email-error" class="error text-danger" for="email"></label>
                            <div class="mb-4"></div>

                            <textarea class="w-100 form-control border-0 py-3" name="message" rows="5"
                                placeholder="Your Message" id="message"></textarea>
                            <label id="message-error" class="error text-danger" for="message"></label>
                            <div class="mb-4"></div>

                            <button type="submit"
                                class="w-100 btn form-control border-secondary py-3 bg-white text-primary">
                                Submit
                            </button>
                        </form>
                    </div>

                    <div class="col-lg-5">
                        <div class="d-flex p-4 rounded mb-4 bg-white" style="margin-top:100px;">
                            <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Address</h4>
                                <p class="mb-2">1702, SAROVAR PLAZA</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Email Us</h4>
                                <p class="mb-2">dhruvtejani1702@gmail.com</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded bg-white">
                            <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Call Us</h4>
                                <p class="mb-2">+91 9328792830</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <!-- </div>
    </div>
    </div> -->
         <?php include('include/footer.php');?>      
        <?php include('include/script.php');?>

        <!-- SweetAlert & jQuery Validate -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

        <script>
            $(document).ready(function () {
                $("#contactForm").validate({
                    errorClass: "text-danger", // Error styling
                    rules: {
                        name: { required: true, minlength: 3 },
                        email: { required: true, email: true },
                        message: { required: true, minlength: 10 },
                        location: { required: true, }
                    },
                    messages: {
                        name: { required: "Please enter your name", minlength: "Name must be at least 3 characters long" },
                        email: { required: "Please enter your email", email: "Please enter a valid email address" },
                        message: { required: "Please enter your message", minlength: "Message must be at least 10 characters long" },
                        location: { required: "please enter your location", }
                    },
                    submitHandler: function (form) {
                        $.ajax({
                            url: "contact.php", // Use the same PHP file
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
                                        $("#contactForm")[0].reset(); // Reset form
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
            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        let latitude = position.coords.latitude;
                        let longitude = position.coords.longitude;
                        let locationInput = document.getElementById("location");

                        // Reverse Geocoding using OpenStreetMap API
                        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data && data.display_name) {
                                    locationInput.value = data.display_name; // Set location as readable address
                                } else {
                                    locationInput.value = `${latitude}, ${longitude}`; // Fallback to coordinates
                                }
                            })
                            .catch(() => {
                                locationInput.value = `${latitude}, ${longitude}`; // Fallback on error
                            });
                    }, function (error) {
                        alert("Error getting location: " + error.message);
                    });
                } else {
                    alert("Geolocation is not supported by this browser.");
                }
            }
        </script>
        <!-- <form method="post" id="contactForm">
    <div class="p-5 bg-light rounded">
        <div class="row g-4">
            <div class="col-12">
                <div class="text-center mx-auto" style="max-width: 700px;">
                    <h1 class="text-primary">Get in touch</h1>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="h-100 rounded">
                    <div class="input-group">
                        <input type="text" id="location" name="location" class="form-control" placeholder="Enter your location">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-primary" onclick="getLocation()">Use My Location</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <input type="text" class="w-100 form-control border-0 py-3" name="name" id="name" placeholder="Your Name">
                <label id="name-error" class="error text-danger" for="name"></label>
                <div class="mb-4"></div>

                <input type="email" name="email" class="w-100 form-control border-0 py-3" placeholder="Enter Your Email" id="email" value="<?php echo $_SESSION['user_email'] ?? ''; ?>">
                <label id="email-error" class="error text-danger" for="email"></label>
                <div class="mb-4"></div>

                <textarea class="w-100 form-control border-0" name="message" rows="5" placeholder="Your Message" id="message"></textarea>
                <label id="message-error" class="error text-danger" for="message"></label>
                <div class="mb-4"></div>

                <button type="submit" class="w-100 btn form-control border-secondary py-3 bg-white text-primary">
                    Submit
                </button>
            </div>
        </div>
    </div>!-->
        <!-- ✅ Correctly closes the form here -->


</body>

</html>
  <?php 
  include "db_connect.php";
  

   if($_SERVER["REQUEST_METHOD" == "POST"]){
    // get data from leave reply
    $name= $conn->real_escape_string($_POST['name']);
    $email=$conn->real_escape_string($_POST['email']);
    $message =$conn->real_escape_string( $_POST['message']);
    
    //insert data into testimonial table
    $sql="INSERT INTO testimonial1 (name,email,message) VALUES ('$name','$email','$message')";
 
    if($conn->query($sql)===TRUE){
        echo json_encode( ["status"=> "success", "message"=>"your feedback  has been submited successfully!"]);
    } else {
        echo json_encode( ["status"=>"error","$message"=>"DATABASE ERROR: " . $conn->error]);
    }
$conn->close();
exit();
   }
  
  ?>
  <form action="#" method="post" id="repltform">
                                <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="border-bottom rounded">
                                        <input type="text" class="form-control border-0 me-4" name="name" id="name"
                                        placeholder="Your Name" >
                                            <label id="name-error" class="error text-danger" for="name"></label>
                                        </div>
                                        
                    
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="border-bottom rounded my-4">
                                            <input type="email"  name="email" id="email";class="form-control border-0 " placeholder="Your Email *" value="<?php echo $_SESSION['user_email'] ?? ''; ?>">
                                            <label id="email-error" class="error text-danger" for="email"></label>
                                        </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class="border-bottom rounded my-4">
                                            <textarea name="message" id="message" class="form-control border-0" cols="30" rows="5" placeholder="Your Review *" spellcheck="false"></textarea>
                                            <label id="message-error" class="error text-danger" for="message"></label>
                                            <div class="mb-4"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between py-3 mb-5">
                                            <div class="d-flex align-items-center">
                                                <p class="mb-0 me-3">Please rate:</p>
                                                <div class="d-flex align-items-center" style="font-size: 12px;">
                                                    <i class="fa fa-star text-primary"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                    
                                            <button href="#" type="submit" class="btn border border-secondary text-primary rounded-pill px-4 py-3"> Post Comment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>


                            <script>
$(document).ready(function () {
    $("#testimonialForm").validate({
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
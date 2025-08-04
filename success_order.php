

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <?php include('include/style.php'); ?>

    <head>
        <style>
            body {
                background-color: #f8f9fa;
            }

            .confirmation-container {
                max-width: 600px;
                margin: 50px auto;
                padding: 20px;
                background: #ffffff;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            .confirmation-icon {
                font-size: 50px;
                color: #81c408 !important;
            }

            .btn-primary {
                background-color: #81c408 !important;
                border-color: #81c408 !important;
            }

            .btn-primary:hover {
                background-color: #6ca306 !important;
                border-color: #6ca306 !important;
            }
        </style>
    </head>

<body>
    <?php include('include/header.php'); ?>
    <div class="container-fluid">
        <div class="container" style="margin-top:200px;">
            <div class="confirmation-container">
                <i class="confirmation-icon bi bi-check-circle-fill"></i>
                <h2 class="mt-3" style="color: #81c408;">Order Confirmed!</h2>
                <p>Thank you for your purchase. Your order has been successfully placed.</p>
                <a href="create_feedback.php" class="btn btn-primary mt-3">share your feedback</a>
                <a href="index.php" class="btn btn-primary mt-3">Back to Home</a>
                <a href="order_history.php" class="btn btn-primary mt-3">Check Order History</a>        
                 </div>
        </div>
    </div>

    
    <?php include('include/footer.php'); ?>
    <?php include('include/script.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#replyForm").validate({
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
</body>

</html>
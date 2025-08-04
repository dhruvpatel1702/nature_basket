<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Condition</title>
    <?php include('include/style.php'); ?>
    <style>
    </style>
</head>
<body>
<?php include('include/header.php'); ?>
    
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Terms & Condition</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active text-white">Terms & Condition</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f8f8;
            color: #45595b;
        }
        
        
        h1 {
            color: #2c3e50;
            text-align: side;
        }
        h2 {
            color: #2c3e50;
            
        }
        p {
            line-height: 1.6;
        }
        ul {
            list-style: none;
            padding-left: 0;
        }
        ul li::before {
            content: ✅;
            color: #27ae60;
            margin-right: 8px;
        }
        
    </style>
</head>
<body>
<div class="container-fluid py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                <h1>Terms & Condition</h1>
                <hr>
                
                <h2>1. Acceptance of Terms</h2>
        <hr>
        <ul>
            <li>✅ By accessing or using Nature Basket, you agree to comply with these terms. If you do not agree, please do not use our services.</li>
        </ul>

        <h2>2. User Responsibilities</h2>
        <hr>
        <ul>
            <li>✅ You must be at least 18 years old or have parental consent.</li>
            <li>✅ Ensure that your account details are accurate and secure.</li>
            <li>✅ You are responsible for all activities under your account.</li>
        </ul>

        <h2>3. Ordering & Payments</h2>
        <hr>
        <ul>
            <li>✅ Orders are confirmed upon successful payment.</li>
            <li>✅ Prices, discounts, and offers may change without prior notice.</li>
            <li>✅ We reserve the right to cancel orders due to stock unavailability or technical errors.</li>
        </ul>

        <h2>4. Delivery & Return</h2>
        <hr>
        <ul>
            <li>✅ We strive for timely deliveries but are not liable for unexpected delays.</li>
            <li>✅ Perishable items (fruits & vegetables) are not eligible for returns unless damaged or incorrect.</li>
            <li>✅ Report any issues within 24 hours of delivery for a resolution.</li>
        </ul>
        <hr>
        <p><strong>Effective Date:</strong> <?php   echo   date("Y/m/d")   ;  ?></p>    
    </div>
    </div>
    </div>

    
    <?php include('include/footer.php');?>
    <?php  include('include/script.php');?>
</body>
</html>
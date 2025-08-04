<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nature-basket</title>
    <?php include('include/style.php'); ?>
</head>
<body>
    <?php include('include/header.php'); ?>
    
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Privacy Policy</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active text-white">Privacy Policy</li>
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
                <h1>Privacy Policy</h1>
                <hr>
                
                <h2>1. What We Collect</h2>
        <hr>
        <ul>
            <li><strong>✅ Personal Data:</strong> Name, phone, address, payment details for order processing.</li>
            <li><strong>✅ Non-Personal Data:</strong> IP address, device info, cookies for analytics.</li>
        </ul>

        <h2>2. How We Use Your Data</h2>
        <hr>
        <ul>
            <li>✅ To process orders & enable deliveries.</li>
            <li>✅ To enhance user experience & provide support.</li>
            <li>✅ To send offers & updates (opt-out anytime).</li>
        </ul>

        <h2>3. Data Sharing & Security</h2>
        <hr>
        <ul>
            <li><strong>✅ No data selling.</strong></li>
            <li>✅ Shared only with delivery partners, payment gateways & legal authorities (if required).</li>
            <li>✅ Strong security measures protect your data.</li>
        </ul>

        <h2>4. Your Rights</h2>
        <hr>
        <ul>
            <li>✅ Access,modify, or delete your data.</li>
            <li>✅ Opt out of marketing communications.</li>
            <li>✅ Contact us for any privacy concerns.</li>
        </ul>
        <p><strong>Effective Date:</strong> <?php   echo   date("Y/m/d")   ;  ?></p>    
    </div>
    </div>
    </div>

    <?php include('include/footer.php'); ?>
    <?php include('include/script.php'); ?>
    <!-- About Us End -->
</body>
</html>
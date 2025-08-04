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
        <h1 class="text-center text-white display-6">About us</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active text-white">About us</li>
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
                <h1>About us</h1>
                <hr>
                <?php echo "<br>";?>
                <p>Welcome to <strong>Nature Basket</strong>, your one-stop destination for fresh and high-quality fruits and vegetables! We are dedicated to bringing farm-fresh goodness straight to your doorstep, ensuring that you and your family enjoy the best nature has to offer.</p>

        <h2>At Nature Basket, we believe in:</h2>
        <hr>
        <ul>
            <li><strong>✅ Freshness First</strong> – We source directly from trusted farms to provide you with the freshest produce.</li>
            <li><strong>✅ Quality You Can Trust</strong> – Every fruit and vegetable is carefully selected to meet the highest standards.</li>
            <li><strong>✅ Convenience at Your Fingertips</strong> – Order easily through our platform and get your groceries delivered fast.</li>
            <li><strong>✅ Sustainability & Ethics</strong> – We support local farmers and promote eco-friendly practices.</li>
        </ul>
        <hr>
        <p> Our mission is to make fresh, nutritious, and affordable produce accessible to everyone. Whether you're looking for seasonal fruits, organic vegetables, or daily essentials, we've got you covered.</p>

        <p><strong>Effective Date:</strong> <?php   echo   date("Y/m/d")   ;  ?></p>    
    </div>
    </div>
    </div>

    <?php include('include/footer.php'); ?>
    <?php include('include/script.php'); ?>
    <!-- About Us End -->
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Nature Basket</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            overflow: hidden;
        }
        .header {
            text-align: center;
            padding: 15px 0;
            background: linear-gradient(90deg, #4CAF50, #2E7D32);
            color: white;
            border-radius: 12px 12px 0 0;
        }
        .header h2 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            text-align: center;
            padding: 25px;
        }
        .content p {
            font-size: 16px;
            color: #333;
            margin-bottom: 15px;
        }
        .highlight {
            font-weight: bold;
            color: #2E7D32;
        }
        .footer {
            text-align: center;
            font-size: 13px;
            color: #555;
            margin-top: 20px;
            padding: 15px;
            background: #f8f8f8;
            border-top: 1px solid #ddd;
            border-radius: 0 0 12px 12px;
        }
        .cta-button {
            display: inline-block;
            padding: 12px 20px;
            margin-top: 15px;
            font-size: 16px;
            color: #fff;
            background: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
            color: #fff !important; /* Ensures text remains white */
        }
        .cta-button:hover {
            background: #2E7D32;
        }   
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>🌿 Welcome to Nature Basket! 🍏</h2>
        </div>
        <div class="content">
            <p>Dear <span class="highlight">{{name}}</span>,</p>
            <p>We're thrilled to have you as part of the Nature Basket family! Your account has been successfully created.</p>
            <p>Your registered email ID: <span class="highlight">{{email}}</span></p>
            <p>Explore fresh, organic, and high-quality products, handpicked just for you. Start shopping now!</p>
            <a href="localhost/Nature-Basket/shop.php" class="cta-button">Shop Now</a>
        </div>
        <div class="footer">
            <p>&copy; 2025 Nature Basket. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>

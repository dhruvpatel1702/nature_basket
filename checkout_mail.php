<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Nature Basket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
        }

        .header {
            text-align: center;
            padding: 20px;
            background: linear-gradient(90deg, #4CAF50, #2E7D32);
            color: white;
            border-radius: 12px 12px 0 0;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        .content p {
            font-size: 16px;
            color: #333;
        }

        .order-details {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .order-details th,
        .order-details td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        .order-details th {
            background: #4CAF50;
            color: white;
        }

        .total-row {
            font-weight: bold;
            background: #f8f8f8;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #555;
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
        }

        .cta-button:hover {
            background: #2E7D32;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>🛒 Order Confirmation</h2>
        </div>
        <div class="content">
            <p>Dear <b>{{customer_name}}</b>,</p>
            <p>Thank you for your order! Here are your order details:</p>
            <table class="order-details">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    {{order_items}}
                </tbody>
                <tfoot>
                    <tr class="total-row">
                        <td colspan="4" align="right">Flat Charge:</td>
                        <td><b>$3</b></td>
                    </tr>
                    <tr class="total-row">
                        <td colspan="4" align="right">Grand Total:</td>
                        <td><b>{{grand_total}}</b></td>
                    </tr>
                </tfoot>
            </table>
            <p>We will notify you once your order is shipped.</p>
            <a href="http://localhost/Nature-Basket/shop.php" class="cta-button">Continue Shopping</a>
        </div>
        <div class="footer">
            <p>&copy; 2025 Nature Basket. All Rights Reserved.</p>
            <p>Follow us on: <a href="#" style="color: #4CAF50; text-decoration: none;">Facebook</a> | <a href="#"
                    style="color: #4CAF50; text-decoration: none;">Instagram</a></p>
        </div>
    </div>
</body>

</html>
<?php 
include "db_connect.php";
session_start();

$user_id = $_SESSION['user_id'];

$user_orders = "SELECT orders.*, products.name as product_name 
                FROM orders 
                JOIN products ON orders.product_id = products.id 
                WHERE orders.user_id = ".$user_id;
                $user_data = mysqli_query($conn, $user_orders);
$user_all_order = mysqli_fetch_all($user_data, MYSQLI_ASSOC);

?>
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
    <div class="container-fluid contact py-5" style="margin-top:100px;">
        <div class="container py-5">
        <div class="order-history-container">
        <h2 class="text-center" style="color: #81c408;">Order History</h2>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Type</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Quantity</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($user_all_order as $order){
                ?>
                <tr>
                <td><?php echo !empty($order['transaction_id']) ? $order['transaction_id'] : 'Cash On Delivery'; ?></td>
                <td> <?php 
        echo ($order['order_type'] == 1) ? 'Cash' : (($order['order_type'] == 2) ? 'Razorpay' : 'Unknown');
    ?></td>
                    <td><?php echo $order['product_name']; ?></td>
                    <td><?php echo $order['product_price']; ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td><?php echo $order['created_at']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-primary">Back to Home</a>
    </div>
        </div>
    </div>
    <?php include('include/footer.php'); ?>
    <?php include('include/script.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>

</html>
<?php 
include "db_connect.php";
session_start();
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Razorpay\Api\Api;

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$address = $_POST['address'];
$city = $_POST['city'];
$country = $_POST['country'];
$mobile = $_POST['mobile'];
$pincode = $_POST['pincode'];
$email = $_POST['email'];
$amount = $_POST['order_price'];
$user_id = $_SESSION['user_id']; // Get user ID from session

$insert_billing = "INSERT INTO billing_address (first_name,last_name, address,city,country,mobile,pincode,email ) 
                VALUES ( '$first_name','$last_name', '$address', '$city', '$country', '$mobile', '$pincode', '$email')";

if (mysqli_query($conn, $insert_billing)) {
    $billing_id = mysqli_insert_id($conn);

    if (!empty($_SESSION['cart'])) {
        $grand_total = 0;
        foreach ($_SESSION['cart'] as $cart_item) {
            $product_id = $cart_item['id'];
            $quantity = $cart_item['quantity'];

            $query = "SELECT name,price FROM products WHERE id = '$product_id'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $product_name = $row['name'];
            $product_price = $row['price'];
            
            $total_price = $product_price * $quantity; // Calculate total for each product
            $grand_total += $total_price; // Sum up grand total

            $insert_order = "INSERT INTO orders (order_type, user_id, transaction_id, billing_id, product_id,product_price, quantity, total_amount) 
                             VALUES ('1', '$user_id', '', '$billing_id', '$product_id', '$product_price','$quantity', '$amount')";
                            // $insert_order = "INSERT INTO orders (order_type, user_id, transaction_id, billing_id, product_id, product_price, quantity, total_amount) 
                             //VALUES ('1', '$user_id', '', '$billing_id', '$product_id', '$product_price', '$quantity', '$total_price')";
            
                        $cart_items[] = [
                            "name" => $product_name,
                            "price" => $product_price,
                            "quantity" => $quantity,
                            "total" =>$total_price
                        ];
            sendOrderEmail($email,$first_name, $cart_items,$amount);

            mysqli_query($conn, $insert_order);
        }
        unset($_SESSION['cart']); // or $_SESSION['cart'] = [];

    }
echo json_encode(["product_price" => $product_price]);
}


function sendOrderEmail($customerEmail,$customerName, $cart_items,$grand_total)
{
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Change this to your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'dhruvtejani1702@gmail.com';
        $mail->Password = 'pkik wnvq oiav icud'; // Use App Password if using Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('dhruvtejani1702@gmail.com', 'Nature Basket');
        $mail->addAddress($customerEmail);

        $template = file_get_contents('checkout_mail.php');

        // Generate cart items HTML
        $cart_html = "";
        foreach ($cart_items as $item) {
            $cart_html .= "<tr>
                            <td>🛍️</td>
                            <td>{$item['name']}</td>
                            <td>\${$item['price']}</td>
                            <td>{$item['quantity']}</td>
                            <td>\${$item['total']}</td>
                           </tr>";
        }

        // Replace placeholders with actual values
        $email_body = str_replace("{{customer_name}}", $customerName, $template);
        $email_body = str_replace("{{order_items}}", $cart_html, $email_body);
        $email_body = str_replace("{{grand_total}}", "₹" . number_format($grand_total, 2), $email_body);




        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "Order Confirmation - Nature Basket";

        $mail->Body = $email_body;

        $mail->send();
    } catch (Exception $e) {
        error_log("Email could not be sent. Error: {$mail->ErrorInfo}");
    }
}

?>
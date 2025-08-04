<?php
session_start();
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];

    if (isset($_SESSION["cart"][$product_id])) {
        unset($_SESSION["cart"][$product_id]); 
        echo json_encode(["success" => true, "message" => "Product removed from cart"]);
    } else {
        echo json_encode(["success" => false, "message" => "Product not found in cart"]);
    }
    exit;
}
?>

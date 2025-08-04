<?php
session_start();
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];

    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    if (!array_key_exists($product_id, $_SESSION["cart"])) {
        $_SESSION["cart"][$product_id] = [
            "id" => $product_id,
            "quantity" => 1
        ];
        echo json_encode(["success" => true, "message" => "Product added to cart"]);
    } else {
        echo json_encode(["success" => false, "message" => "Product is already in the cart"]);
    }
}
?>

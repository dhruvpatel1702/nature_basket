<?php
session_start();
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $action = $_POST["action"]; // 'plus' or 'minus'

    if (isset($_SESSION["cart"][$product_id])) {
        if ($action == "plus") {
            $_SESSION["cart"][$product_id]["quantity"]++;
        } elseif ($action == "minus" && $_SESSION["cart"][$product_id]["quantity"] > 1) {
            $_SESSION["cart"][$product_id]["quantity"]--;
        }

        echo json_encode([
            "success" => true,
            "new_quantity" => $_SESSION["cart"][$product_id]["quantity"]
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Product not found in cart"]);
    }
    exit;
}
?>

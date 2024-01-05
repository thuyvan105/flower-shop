<?php
// Code trong add_to_cart.php
include('cartFunction.php');
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$pdID = $_POST['pdID'];
$image = $_POST['image'];
$name = $_POST['name'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$userId = $_POST['userId'];

$product = [$pdID, $image, $name, $price, $quantity, $userId];
$productExists = false;

foreach ($_SESSION['cart'] as $productKey => $p) {
    if (is_array($p)) {
        if ($p[0] == $product[0]) {
            $_SESSION['cart'][$productKey][4]++;
            $productExists = true;
            break;
        }
    }
}

if (!$productExists) {
    $_SESSION['cart'][] = $product;
}

$cartHTML = showCartItems();
$total = total();
$response = ['html' => $cartHTML, 'total' => $total];
echo json_encode($response);
?>

<?php
// session_start();
$userId = $_SESSION['id'];

// ...

// Hiển thị các mục giỏ hàng
foreach ($cartItems as $cartItem) {
    // ...

    // Hiển thị ID người dùng
    echo $cartItem['userId'];
}


header('location:index.php');
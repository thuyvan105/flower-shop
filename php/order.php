<?php
    function addToYourOrder($id) {
        global $conn;
    $order = $_SESSION['cart'];
    foreach($order as $item) {
        $productID = $item['productID'];
    $user = mysqli_query($conn, "INSERT INTO `giohang`(`id_user`, `id_sp`, `soluong`) VALUES ($id, $item.$productID,'[value-4]')");
    if (mysqli_num_rows($user) > 0) {
        echo "invalid";
    } else {
        echo "valid";
    }

    }
}
?>
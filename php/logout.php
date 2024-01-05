<?php
require 'funLogin.php';
$_SESSION = [];
session_unset();
if (isset($_SESSION['id_user'])) {
    $user_id = $_SESSION['id_user'];
    setcookie('cart_' . $user_id, '', time() - 3600, '/');
}
session_destroy();
header("Location: login.php");
?>

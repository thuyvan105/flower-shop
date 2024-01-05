<?php
require_once 'include/header.php';
session_start();

// Kiểm tra xem có tồn tại order_id trong session hay không
if (isset($_SESSION['order_id'])) {
    $order_id = $_SESSION['order_id'];
    // Nếu tồn tại order_id, thực hiện các hành động cần thiết
    // Ví dụ: hiển thị thông báo và link chi tiết đơn hàng
} else {
    // Nếu không có order_id, có thể xử lý hoặc hiển thị thông báo phù hợp
    echo "Không tìm thấy thông tin đơn hàng.";
}

// Lưu ý rằng bạn cần phải có logic để xử lý order_id, chẳng hạn như truy vấn cơ sở dữ liệu để lấy thông tin chi tiết đơn hàng.
?>

<body>
    <br><br><br><br><br><br>
    <div style="margin-left: 40%; font-size:30px">
        <h1>THANK YOU</h1>
    
    </div><br>
    <!-- <div style="margin-left: 20%; margin-right:20%; font-size: 22px">
        <p style="text-align:center;">You have placed your order successfully! </p>
        
    </div> -->
    <div style="margin-left: 35%; font-size: 17px">
    <p>You have placed your order successfully! </p>

    <p>Your purchase invoice has been transferred to the Order page. <br>
        See here <?php
        // Nếu có order_id, hiển thị link chi tiết đơn hàng
        if (isset($order_id)) {
            echo '<a href="paysuccess.php?order_id=' . $order_id . '">Order Detail</a>';
        }
        ?> <br>
        You will receive the goods within 3-5 days from the date of order. <br>
        Don't forget to rate this purchasing experience. <br>
        Thank you for your trust and support of BLUME.</p>
    </div>
</body>

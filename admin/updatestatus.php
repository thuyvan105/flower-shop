    <?php
    require_once './config/dbconnect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["order_id"]) && !empty($_POST["order_id"])) {
        $order_id = $_POST["order_id"];

        // Thực hiện cập nhật trạng thái trong cơ sở dữ liệu
        $update_query = "UPDATE `order` SET order_status = 1 WHERE order_id = '$order_id'";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            echo 'approved';
        } else {
            echo 'error';
        }
        
    } else {
        echo 'invalid request';
    }
    ?>

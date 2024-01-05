<?php
include_once './includes/header.php';
include_once './includes/navbar.php';

require_once './config/dbconnect.php';
?>

<body>
    <div style="overflow-x:auto;">
    <form action="" method ="post">

        <table class="table table-hover" style="width:70%; margin-left: 15%; margin-top:5%; text-align: center;">
            <thead>
                <tr style="background-color: #a05099; color:white; margin-left:500px;">
                    <th scope="col">ID Order</th>
                    <th scope="col">Name Buyer</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Total</th>
                    <th scope="col">Detail</th>
                    <th scope="col">Browser</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT `order`.*, SUM(`order_detail`.`quantity` * `order_detail`.`price`) AS total FROM `order`
                        LEFT JOIN `order_detail` ON `order`.`order_id` = `order_detail`.`order_id`
                        GROUP BY `order`.`order_id` DESC limit 9 ";
                $query = mysqli_query($conn, $sql);

                if (!$query) {
                    die("Error: " . mysqli_error($conn));
                }

                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                    <tr>
                        <th style="font-size:16px; text-transform: capitalize;">BD00<?= $row['order_id'] ?> </th>
                        <th style="font-size:16px; text-transform: capitalize;"><?= $row['ten_nguoi_nhan'] ?> </th>
                        <th style="font-size:16px; text-transform: capitalize;"><?= $row['order_date'] ?> </th>
                        <th style="font-size:16px; text-transform: capitalize;"><?= $row['total'] ?> </th>
                        <td>
                            <a href="order.php?order_id=<?= $row['order_id'] ?>">Order Detail</a>
                        </td>
                        <td>
                            <button id="statusBtn_<?= $row['order_id'] ?>" onclick="updateStatus(<?= $row['order_id'] ?>)">Browser</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateStatus(order_id) {
            $.ajax({
                type: "POST",
                url: "updatestatus.php",
                data: { order_id: order_id },
                success: function (response) {
                    if (response === 'approved') {
                        // Đã duyệt
                        $("#statusBtn_" +order_id).html("Approved").css("background-color", "green");

                    } else {
                        // Có lỗi hoặc trạng thái không phải đã duyệt
                        console.log(response);
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    </script>
</body>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>

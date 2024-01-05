<?php
require_once 'include/header.php';
require "../admin/config/dbconnect.php";

// Lấy order_id từ tham số truyền vào URL
$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';

// Thực hiện truy vấn để lấy thông tin đơn hàng từ bảng order
$sql_order = "SELECT * FROM `order` WHERE `order_id` = '$order_id'";
$query_order = mysqli_query($conn, $sql_order);

// Thực hiện truy vấn để lấy thông tin chi tiết đơn hàng từ bảng order_detail
$sql_detail = "SELECT * FROM order_detail WHERE order_id = '$order_id'";
$query_detail = mysqli_query($conn, $sql_detail);

?>
<link rel='stylesheet' type='text/css' media='screen' href='../css/oderdetail.css'>

<div class="container" style="margin-top: 100px;">
      <article class="card">
          <!-- <header class="card-header"> My Orders / Tracking </header> -->
          <div class="card-body"><br>
          <?php
        // Hiển thị thông tin chi tiết đơn hàng
        while ($row_order = mysqli_fetch_array($query_order)) {
        ?>
            <h4 style="margin-left: 13px; font-size:18px;">ID Order: <?php echo $row_order['order_id']; ?></h4><br>
            <article class="card">
                <div class="card-body row" style="display:flex;left:0px;">
                    <div class="col" style="margin-right:50px !important"> <strong>Tên người nhận:</strong><br> <?php echo $row_order['ten_nguoi_nhan']; ?></div>
                    <div class="col" style="margin-right:50px !important"> <strong>Ngày đặt hàng:</strong> <br> <?php echo $row_order['order_date']; ?></div>
                    <div class="col" style="margin-right:50px !important"> <strong>Nơi gửi:</strong> <br> Blume Shop</div>
                    <div class="col" style="margin-right:50px !important"> <strong>Địa chỉ nhận:</strong> <br> <?php echo $row_order['address']; ?></div>
                    <div class="col" style="margin-right:50px !important"> <strong>Trạng thái:</strong> <br> <?php echo $row_order['order_status']; ?></div>
                    <!-- <div class="col"> <strong>Mã vận đơn:</strong> <br> <?php echo $row_order['tracking_number']; ?></div> -->
                </div>
            </article>
        <?php } ?>


              <div class="track">
                  <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Xác nhận</span> </div>
                  <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Đang đóng gói</span> </div>
                  <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> Đang vận chuyển </span> </div>
                  <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Đang giao hàng</span> </div>
              </div>
              <hr>

              <?php
    foreach ($query_detail as $product) {
        $product_id = $product['product_id'];
        $sql_product_info = "SELECT * FROM sanpham WHERE id_sp = '$product_id' limit 1";
        $query_product_info = mysqli_query($conn, $sql_product_info);
        $product_info = mysqli_fetch_assoc($query_product_info);

        if (is_array($product_info)) {
            $productName = $product_info['ten_sp'];
            $productPrice = $product['price'];
            $productQuantity = $product['quantity'];
            $productImage = $product_info['anh_mota'];
        ?>
            <div class="row" style="width:100% !important;margin:0 !important; padding:10px">
                <div class="col" style="width:100%">
                    <div class="card card-2" style="width:100%">
                        <div class="item" style="width:100%; padding:10px">
                            <img src="../admin/img/<?php echo $productImage ?>" alt="" class="imgg">
                            <div class="tensl" style="width:100%">
                                <p><?php echo $productName ?> 
                                <p> <br>$<?php echo $productPrice ?></p>
                            </div>
                            <span style="margin-left: auto; font-size: 15px">X<?php echo $productQuantity ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        <?php } }?>
        
        <div class="row invoice" style="display:flex;">
            <!-- Thay đổi dòng dưới để hiển thị thông tin tổng giá trị đơn hàng -->
            <p style="margin-left: 60px; font-size: 20px; margin-top: 10px; font-weight: bold;">Total</p>
            <?php
            $totalAmount = 0;
            foreach ($query_detail as $product) {
                if (is_array($product)) {
                    $totalAmount += $product['price'] * $product['quantity'];
                }
            }
            echo "<p style='color:black; font-size:20px;font-weight: bold; padding-top:10px;'>Total: <span style='margin-left:550px; font-weight: bold;'><b>$$totalAmount</b></span></p>";
            ?>
        </div>

              
      <!-- </article> -->
      
  </div><br>
             <div style="margin-left:80px;margin-bottom:20px; height:40px;">
              <a href="index.php" class="btn btn-warning" data-abc="true" stlye="height: 80px;"><i class="fa fa-chevron-left"></i> Go back home</a>
          </div>

<!-- FOOTER -->

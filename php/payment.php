<?php 
require 'include/header.php';
// include('cartFunction.php');
echo($_SESSION['cart']);

require "../admin/config/dbconnect.php";
// session_start();
$id_user = $_SESSION['id_user'];

if(isset($_POST['submit'])){
  if($_SESSION['cart'] == [] || $_SESSION['cart'] == null){
    echo "<script>alert('Vui lòng thêm sản phẩm vào giỏ hàng trước khi đặt.')</script>";
  }else{
    $name_user = isset($_POST['name_user']) ? $_POST['name_user'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $order_date = date("Y-m-d H:i:s");
  
    if(!empty($name_user) && !empty($address) && !empty($phone) && !empty($city)){
        $sql_order = "INSERT INTO `order` (id_user, ten_nguoi_nhan, number_phone, address, city, order_date) VALUES ('$id_user', '$name_user', '$phone', '$address', '$city', '$order_date')";
        $query_order = mysqli_query($conn, $sql_order);
  
        if (!$query_order) {
            echo "Error: " . mysqli_error($conn);
        }
        $order_id = mysqli_insert_id($conn);
  
  
    $_SESSION['order_id'] = $order_id;
  
    // Thêm thông tin giỏ hàng vào bảng order_detail
    $done = 0;
    foreach ($_SESSION['cart'] as $product) {
      if (is_array($product)) {
        $product_id = $product[0];
        $quantity = $product[4];
        $price = $product[3];
  
        $sql_order_detail = "INSERT INTO order_detail (order_id, id_user, quantity, price,product_id) VALUES ('$order_id', '$id_user', '$quantity', '$price','$product_id')";
        $query_order_detail = mysqli_query($conn, $sql_order_detail);
        if(!$query_order_detail){
            $done++;
        }
      }
    }
    if ($done == 0) {
      $_SESSION['cart'] = array();
      header("Location: ../php/thankyou.php?success");
      exit();
    } else {
      echo "đã có lỗi xảy ra !";
    }
    } else {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin.')</script>";
    }
  
    // Lấy ID vừa thêm
    
  }
  
}




?>
<!-- <link rel='stylesheet' type='text/css' media='screen' href='../css/payment.css'> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="row" style ="display:flex; margin-top:-30%; margin-left:130px">
  <div class="col-75" >
    <div class="container" style="background-color: white; border-radius: 2%; width:700px">
      <form method ="post">
        <div class="row" style ="margin-top:-20%;margin-left:130px">

          <div class="col-50">
            <h3>Information</h3>

          <?php
              $sql_user = "SELECT * FROM user where id_user ='$id_user'";
              $query_user = mysqli_query($conn, $sql_user);
              // $row_user = mysqli_num_rows($sql_user);
              while($row_user = mysqli_fetch_array($query_user)) {
              ?>

            <label for="fname"><i class="fa fa-user"></i> Name</label>
            <input type="text" id="fname" name="name_user" placeholder="John M. Doe" value="<?php echo $row_user['name_user']; ?>">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com" value="<?php echo $row_user['email']; ?>">
            <?php
              }
              ?>  

            <label for="adr"><i class="fa fa-address-card-o"></i> Address </label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
            <label for="city"><i class="fa fa-institution"></i>City</label>
            <input type="text" id="city" name="city" placeholder="New York">

            <div class="row">
              <div class="col-50">
                <label for="state">Phone Number</label>
                <input type="text" id="state" name="phone" placeholder="+84">
              </div>
            
            </div>
          </div>

          
        </div>
        <label style="margin-left: 40px;">
          <input type="checkbox" checked="checked" name="sameadr"> Confirm Information
        </label>
        <button class="btn" name="submit" style="background-color: black;">Payment</button>

        </div>
  </div>
  <div class="col-25" style= "boder-radius: 15px; height: 300px; margin-left:70%; margin-top:30px;"><br>
    <div class="container" style= "boder-radius: 15px; height: auto;width:400px; "> 

    <?php
    $totalCart = 0;
    foreach ($_SESSION['cart'] as $product) {
    if (is_array($product)) { 
        $totalCart++;
      }
    }
      ?>
      <h4 style="margin-top: 20px;">CART <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo $totalCart ?></b></span></h4>
    <?php
    foreach ($_SESSION['cart'] as $product) {
    if (is_array($product)) {
        $productName = $product[2];
        $productPrice = $product[3];
        $productQuantity = $product[4];
        $productImage = $product[1];
?>
      <br>
        <div style="display: flex;">
            <img src="<?php echo $productImage ?>" alt="" style="width: 100px; height: 100px; margin-right: 20px;">
            <br><p><a href="#" style="margin-top: 0; margin-left: 10px; z-index: 1; text-transform: capitalize; margin-right: 70px;"><?php echo $productName ?></a>
                <span class="price"> x <?php echo $productQuantity ?></span><br><br>
                <span style="margin-left: 13px; font-size:16px; color:#666666 ">Price: $<?php echo $productPrice ?></span>
            </p>
        </div>
<?php

    }
}
?>
      <br><hr> 
      <?php
            $totalAmount = 0;
            foreach ($_SESSION['cart'] as $product) {
                if (is_array($product)) {
                    $totalAmount += $product[3] * $product[4];
                }
            }
            echo "<p style='color:black; font-size:20px;font-weight: bold; padding-top:10px;'  >Total: <span style='margin-left:220px; font-weight: bold;'><b>$$totalAmount</b></span></p>";
            

      // <p>Total: <span class="price" style="color:black"><b></b></span></p>
      ?>
    </div>
  </div>

    </form>

    
</div>

<?php
include 'include/footer.php';
?>
<style>
body {
    font-size: 17px;
    /* margin-left: 20%; */
    /* background: linear-gradient(45deg ,#098dc1,60% ,#f417de); */
    background-color: #fff;
    font-family: "Verdana", sans-serif;

  }

  :root{
    --bg-color: #fff;
    --main-color:rgb(168, 90, 177);
    --text-color: #010101;
    /* --2nd-color: #434343; */
    --other-color: #666666;
    --big-font: 5rem;
    --h2-font: 2.3rem;
    --p-font: 1.3rem;
    --blue: #c900b8;
    font-family: "Verdana", sans-serif;

}
  
  * {
    box-sizing: border-box;
    font-family: "Verdana", sans-serif;

  }
  .btn{
      width: 100%;
      height: 40px;
      margin-top: 20px;
      border-radius: 50px;
      border: none;
      outline: none;
      font-size: 19px;
      font-weight: 500;
      color:  white;
      position: relative;
      cursor: pointer;
      z-index: 1;
      overflow: hidden;
      font-family: "Verdana", sans-serif;

  }
  .btn::before{
      content: "";
      position: absolute;
      left: 0;
      top: 0%;
      height: 100%;
      width: 00%;
      transition: .5s ease;
      z-index: -1;
  }
  .btn:hover{
      color: #eee;
  }
  .btn:hover:before{
  width: 100%;
  }


  .col-25 {
    -ms-flex: 35%; /* IE10 */
    flex: 35%;
    /* width: 300px; */
  }
  .col-50 {
    -ms-flex: 50%; /* IE10 */
    flex: 50%;
  }
  
  .col-75 {
    -ms-flex: 65%; /* IE10 */
    flex: 65%;
  }

    
  .col-25,
  .col-50,
  .col-75 {
    padding: 0 16px;
    width: 600px;
    font-family: "Verdana", sans-serif;

  }
  
  .container {
    background-color: white ;
    padding: 5px 20px 15px 20px;
    border-radius: 15px;
    border: 1px solid lightgrey;
    margin-top: 20%;
    margin-left: 25%;
    font-family: "Verdana", sans-serif;

  }
  
  input[type=text] {
    width: 100%;
    margin-bottom: 20px;
    padding: 12px;
    font-size:16px;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-family: "Verdana", sans-serif;

  }

  label {
    margin-bottom: 10px;
    display: block;
    font-family: "Verdana", sans-serif;

  }
  
  .icon-container {
    margin-bottom: 20px;
    padding: 7px 0;
    font-size: 24px;
    font-family: "Verdana", sans-serif;

  }
</style>
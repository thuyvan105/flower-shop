<?php
require "../admin/config/dbconnect.php";
require '../php/funLogin.php';
// session_start();
// Kiểm tra xem có tồn tại order_id trong session hay không
if (isset($_SESSION['order_id'])) {
    $order_id = $_SESSION['order_id'];
    // Nếu tồn tại order_id, thực hiện các hành động cần thiết
    // Ví dụ: hiển thị thông báo và link chi tiết đơn hàng
} 
// else {
//     echo "Không tìm thấy thông tin đơn hàng.";
// }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>WEB</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/index.css'>

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Leckerli+One&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-ez1Ly8ZI+6Fz1PFSzH3Z+U5jt1GQ2a9LGzY+//Su8Q57bI0DTXnt9T4jKJpWSo9g" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>
    <!-- header -->
    <header>
        <!-- <i class="fa-brands fa-pagelines" style="color: black; font-size: 40px; "></i> -->
        <a href="index.php" class="logo"
            style="margin-left: 1px;  font-stretch: ultra-expanded; letter-spacing: 5px;color:red;">
            BLU<span style="color:black;  font-stretch: ultra-expanded; letter-spacing: 3px;" class="logo">ME</span>
        </a>
        <nav>
            <ul class="navbarr">
                <li><a href="#">HOME</a></li>
                <!-- <li><a href="#">Giới thiệu</a></li> -->
                <li><a href="allSP.php">PRODUCT </a>
                <li><a href="#">Fb</a></li>
                <li><a href="#">CONTACT</a></li>
                <!-- <li><a href="#">Đăng xuất</a></li> -->
            </ul>
        </nav>
        <div class="icons js-car">
              <i class='bx bx-shopping-bag' onclick="cartAppear()" style="cursor: pointer;"></i>
            <ul class="navbar">
                <li class="user-icon">
                    <i class='bx bxs-user'>
                    <?php  
             if (isset($_SESSION['name_user']) && ($_SESSION['name_user'] != "")) : ?>
                <?php echo $_SESSION['name_user']; ?>
          
        <?php endif; ?>
                        <ul class="user-menu">
                            <li><a href="../php/login.php">Login</a></li>
                            <li><a href="logout.php">Logout</a></li>
                            <?php
        // Nếu có order_id, hiển thị link chi tiết đơn hàng
        if (isset($order_id)) {
            echo '<li><a href="paysuccess.php?order_id=' . $order_id . '">Order detail</a></li>';
        }
        ?>
                            <!-- <li></li> -->
                        </ul>
                    </i>
                </li>
            </ul>
            <div class="bx bx-menu" id="menu-icons"></div>
        </div>
    </header>
</body>

<div id="js-cart-list"
    style="z-index:1001;border:1px solid #ccc;padding:20px;position:fixed;width:360px;right:0;top:0;bottom:0;background-color:#fefefe; transform: translateX(100%); transition: transform 0.2s linear">
    <div class="header" style="display:flex;justify-content:space-between;align-items:center">
        <h3>CART</h3>
        <button class="js-close"
            style="background:white;border:none;padding:4px;border-radius:8px;cursor:pointer;font-size:30px" onclick="cartDisappear()">X</button>
    </div>
    <div class="" style="overflow:auto;height:100%">
        <div class="list">
        <?php
         include('cartFunction.php');
         $cartList = showCartItems();
         echo $cartList;
      ?>
        </div>
        <div style="border:1px solid #ccc;margin-top:20px;margin-bottom:20px;width:100%;"></div>

        <div class="quality"
            style="margin-top:20px;display:flex;justify-content: space-between;padding:8px;border-radius:8px;">
            <div>Total :</div>
            <div style="display: flex; align-items: center; justify-content: center">
                <span>$</span>
                        <div class="amount fl-ct amoJS js-money" style="display:flex;align-items:center" id="total">

                        </div>
            </div>
        </div>
        <?php
// Đảm bảo session được khởi động trước khi sử dụng biến $_SESSION
if (isset($_SESSION['id_user']) && $_SESSION['id_user'] != "") : ?>
    <a href="payment.php?id_user=<?php echo $_SESSION['id_user'] ?>" class=""
       style="margin-bottom:100px;display:flex;justify-content:center;align-items:center;padding:10px 0;margin-top:20px;width:100%;color:white;background:#47474c;">
        Payment
    </a>
<?php else : ?>
    <a href="login.php" class=""
       style="margin-bottom:100px;display:flex;justify-content:center;align-items:center;padding:10px 0;margin-top:20px;width:100%;color:white;background:#47474c;">
       Login to buy
    </a>
<?php endif; ?>

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        let $pdID = $(this).data('page');
        console.log($pdID);
        $.ajax({
            type: "POST",
            url: "delete-item.php",
            data: {
                pdID: $pdID
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var cartHTML = data.html;
                var total = data.total;
                $('.list').empty();
                $('.list').html(cartHTML);
                $('#total').html(total);
                $('#js-cart-list').show();
            }
        });

    });
    // $('.js-close').click(function (e) {
    //     e.preventDefault();
    //     $('.js-cart-list').hide();
    // })
    // $(document).on('click', '.js-cart', function (e) {
    //     e.preventDefault();
    //     $('.js-cart-list').show();
    // })
    $(document).on('click', '.plus', function (e) {
        let $this = $(this);
        let $input = $this.closest('.amount').find('.m-change-quantity');
        let $current = parseInt($input.val());

        // Tăng giá trị lên 1 đơn vị
        $input.val($current + 1);
    });

    $(document).on('click', '.minus', function (e) {
        let $this = $(this);
        let $input = $this.closest('.amount').find('.m-change-quantity');
        let $current = parseInt($input.val());

        // Giảm giá trị đi 1 đơn vị, nhưng không được nhỏ hơn 0
        if ($current > 0) {
            $input.val($current - 1);
        }
    });
    function cartAppear() {
        var x = document.getElementById("js-cart-list");
        x.style.transform = "translateX(0%)";
    }

    function cartDisappear() {
        var x = document.getElementById("js-cart-list");
        x.style.transform = "translateX(100%)";
    }
</script>
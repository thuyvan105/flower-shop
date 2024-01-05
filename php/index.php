<?php
require "include/header.php";
require "../admin/config/dbconnect.php";
// if (isset($_SESSION['id'])) {
//     $userId = $_SESSION['id'];
// } else {
//     $userId = 0;
// }?>
<!-- HOME -->

<section class="home" style="background-image: url(../img/nenn.png);height: 100vh;">
    <div class="home-text">
        <!-- <h1>Hana</h1>  -->
        <p
            style="font-size: 43px;  line-height: 1.2; color: black; margin-top: 27%; margin-left:20px;font-family: 'Times New Roman', Times, serif;">
            Send <span style="color:red;">flowers</span> like <br> you mean it.</p> <br>
        <p
            style="font-size: 22px;  line-height: 1.8; font-stretch: expanded; margin-left:20px;font-family: 'Times New Roman', Times, serif;">
            Where flowers are our inspiration to creat <br> lasting memories. Whatever the occasion, <br>
            our flowers will make it special cursus<br> a sit amet mauris.</p>
        <!-- <a href="#" class="btn">Mua ngay</a> -->
    </div>
</section>

<!-- BANNER -->

<section class="banner">
    <div class="banner-img" style="height: 220px;">
        <img src="../img/vc2.png" style="height: 250px;">
    </div>

    <div class="banner-img" style="height: 220px;">
        <img src="../img/vc1.png" style="height: 250px;">
    </div>
</section>

<!-- NEW PRODUCT -->

<section class="new-product" data-query="1"
    style="display:flex;justify-content:center; align-items:center; flex-direction:column">
    <!-- <div class="center-text">
            <h3> Sản Phẩm Mới</h3>
        </div> -->
    <div class="navbar" style="color: #000;justify-content:left;">
        <?php
        // Assume $conn is your database connection
        $categorySql = "SELECT * FROM danhmuc";
        $categoryResult = mysqli_query($conn, $categorySql);
        echo "<a href='#' style='padding:6px 12px;border-radius:12px; font-size: 16px;  font-stretch: ultra-expanded; letter-spacing: 3px;' class='category-link' data-category-id='0'>New Product</a>";

        while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
            echo "<a href='#' style='padding:6px 12px;border-radius:5px;font-size: 16px;letter-spacing: 3px; font-stretch: ultra-expanded; ' class='category-link' data-category-id='{$categoryRow['id_dm']}'>{$categoryRow['name_dm']}</a>";
        }
        ?>
    </div><br>


    <div class="new-content" id="productContainer">
        <?php $sql = "SELECT * FROM sanpham ORDER BY id_sp DESC limit 8";
        $query = mysqli_query($conn, $sql);
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($query)) { ?>
                <div class="row">
                    <a href="product-detail.php?id_sp=<?= $row['id_sp'] ?>"><img style="width:100%"
                            src="../admin/img/<?= $row['anh_mota'] ?>" alt=""> </a>
                    <h4 style="width:100%">
                        <?= $row['ten_sp'] ?>
                    </h4>
                    <h5 style="width:100%; margin-bottom:10px;">$
                        <?= $row['gia_sp'] ?>
                    </h5>
                    <!-- <div class="top">
                            <p>Hot</p>
                        </div> -->

                    <div class="bbtn">
                        <a href="cart.php?id_sp<?= $row['id_sp'] ?>" data-page="<?= $row['id_sp'] ?>" class="js-add-cart"
                            onclick="cartAppear()">ADD TO
                            CART</a>
                    </div>
                </div>

                <?php
            }
        } ?>
    </div>

</section>




<section class="page">
    <div style="margin-left:23px;">
        <video width="100%" height="400" tabindex="0" controls
            poster="https://fiorello.qodeinteractive.com/wp-content/uploads/2018/04/h3-video-img.jpg">
            <source src="../img/vd.mp4" type="video/mp4" width="50%" height="360" tabindex="0">
            <!-- Your browser does not support the video tag. -->
        </video>
    </div>

    <div class="thongdiep"><br>
        <h3>Suprise Your <span
                style="color: rgb(255, 38, 0);font-family: 'Times New Roman', Times, serif;">Valentine!</span>
            <br>Let us arrange a smile.
        </h3>
        <p>Where flowers are our inspiration to create lasting <br> memories. Whatever the occasion...</p><br>
        <p><i class="fa-solid fa-heart" style="color:red;"></i> Hand picked just for you.</p>
        <p><i class="fa-solid fa-heart" style="color:red;"></i> Unique flower arrangements.</p>
        <p><i class="fa-solid fa-heart" style="color:red;"></i> Best way to say you care..</p>

    </div>

</section>


<!-- BLOG -->

<section class="blog">
    <div class="center-text">
        <h2> Latest News</h2>
    </div>

    <div class="blog-content">
        <div class="main-box">
            <div class="box-img">
                <img src="../img/n14.jpg">
            </div>
            <div class="in-bxx">
                <div class="in-text">
                    <p>October 7, 2023</p>
                </div>
                <div class="in-icon">
                    <a href="#">
                        <i class="bx bx-message-rounded"></i>
                    </a>
                </div>
            </div>
            <h3> How to properly cut flower stems</h3>
        </div>

        <div class="main-box">
            <div class="box-img">
                <img src="../img/n10.jpg">
            </div>
            <div class="in-bxx">
                <div class="in-text">
                    <p>October 7, 2023</p>
                </div>
                <div class="in-icon">
                    <a href="#">
                        <i class="bx bx-message-rounded"></i>
                    </a>
                </div>
            </div>
            <h3> How to properly cut flower stems</h3>
        </div>

        <div class="main-box">
            <div class="box-img">
                <img src="../img/n15.jpg">
            </div>
            <div class="in-bxx">
                <div class="in-text">
                    <p>October 7, 2023</p>
                </div>
                <div class="in-icon">
                    <a href="#">
                        <i class="bx bx-message-rounded"></i>
                    </a>
                </div>
            </div>
            <h3> How to properly cut flower stems</h3>
        </div>
    </div>
</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    $(document).on('click', '.js-add-cart', function (e) {
        e.preventDefault();
        let $data = $(this).closest('.row');
        let $image = $data.find('img').attr('src');
        let $name = $data.find('h4').text();
        let $priceText = $data.find('h5').text();
        let $price = $priceText.replace("$", "");
        let $pdID = $(this).data('page');
        let $quantity = 1;
        console.log($pdID);
        $.ajax({
            type: "POST",
            url: "add_to_cart.php",
            data: {
                pdID: $pdID,
                image: $image,
                name: $name,
                price: $price,
                quantity: $quantity,
                userId: <?php echo $_SESSION['id'] ?? 0; ?> 
            },
            dataType: 'json',
            success: function (data) {
                var cartHTML = data.html;
                var total = data.total;
                // console.log(cartHTML);
                $('.list').html(cartHTML);
                $('#total').html(total);
                $('.js-cart-list').show();
            }
        });


    });
</script>
<script>
    $(document).ready(function () {
        $(".category-link").click(function (e) {
            e.preventDefault();
            var categoryId = $(this).data("category-id");
            if (categoryId == 0) {
                categoryId = '-1';
            }
            let $container = $(this).closest('.new-product').data("query");
            if ($container == 1) {
                $("#productContainer").addClass("fade");
            } else {
                $("#productContainer2").addClass("fade");
            }

            $.ajax({
                type: "POST",
                url: "get_products_by_category.php",
                data: {
                    category_id: categoryId,
                    type: $container
                },
                success: function (response) {
                    if ($container == 1) {
                        $("#productContainer").html(response);
                        setTimeout(function () {
                            $("#productContainer").removeClass("fade");
                        }, 600);
                    } else {
                        $("#productContainer2").html(response);
                        setTimeout(function () {
                            $("#productContainer2").removeClass("fade");
                        }, 600);
                    }
                }
            });
        });
    });

    // Lấy tất cả các phần tử a trong navbar
    var navbarLinks = document.querySelectorAll('.navbar a');

    // Đặt sự kiện click cho mỗi phần tử
    navbarLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            // Loại bỏ lớp active từ tất cả các liên kết
            navbarLinks.forEach(function (innerLink) {
                innerLink.classList.remove('active');
            });

            // Thêm lớp active cho liên kết được nhấn vào
            link.classList.add('active');
        });
    });

</script>

<!-- FOOTER -->
<?php require_once 'include/footer.php';
?>
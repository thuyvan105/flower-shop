<?php
require "include/header.php";
require "../admin/config/dbconnect.php";
// session_start();

$id_sp = $_GET['id_sp'];
// $id_dm = $_POST['id_dm'];
// $id_user = $_SESSION['id_user']; 


$sql_dm = "SELECT sanpham.*, danhmuc.name_dm
FROM sanpham
JOIN danhmuc ON sanpham.id_dm = danhmuc.id_dm
WHERE sanpham.id_sp = '$id_sp';";
$query_dm = mysqli_query($conn, $sql_dm);
$row_dm = mysqli_fetch_array($query_dm);


$sql_sp = "select * from sanpham where id_sp ='$id_sp' ";
$query_sp = mysqli_query($conn, $sql_sp);
$row_sp = mysqli_fetch_array($query_sp);

?>

<link rel='stylesheet' type='text/css' media='screen' href='../css/product-detail.css'>

<body>
    <div class="body-wrapper"></div>

    <!-- Main item container -->
    <main class="item">
    <section style="margin-top: 20px;margin-left:80px;">
        <p style="font-size:30px; font-weight:548; line-height: 2;">Product List</p>
        <p style="font-size:15px; color: #8c8c8c">Where flowers are our inspiration</p>
      </section> <br>

      <section style=" margin-top: -200px; margin-left:80px;">
        <img  style="width:80%; height:90%;"  src="../admin/img/<?= $row_sp['anh_mota'] ?>"  alt="">
      </section>

     
      <section class="price" style="margin-top:-190px; margin-left:-140px ">
        <p class="price-txt" style="font-size:27px; text-transform: uppercase;"><?= $row_sp['ten_sp'] ?></p>
        <p style="font-stretch: ultra-expanded; letter-spacing: 2px; font-size:18px; color: #8c8c8c;">$<?= $row_sp['gia_sp'] ?> </p>
        <p style="font-size:16px;color:#666666" >
          <?= $row_sp['chitiet_sp']; ?>
        </p>
        <p style="font-size:16px;text-transform: capitalize; color:#666666">
          <span style="font-weight:560;color:#666666">Categories: </span><?= $row_dm['name_dm'] ?></p>
        <p style="font-size:16px;">
        <span style="font-weight:560;color:#666666">Status:</span> 
        </p>


        <div style="font-size:15px; height:38px; background-color:black; color:white; width:150px;  border-radius: 4px;" onclick="cartAppear()">
            <a href="cart.php?id_sp<?= $row['id_sp'] ?>" data-page="<?= $row['id_sp'] ?>" style=" color:white; padding-left:16px;" class="js-add-cart" >ADD TO CART</a>
         </div>
      </section>

      <!-- hiển thị bình luận -->
      <section>
      <?php
          $sqlComment = "SELECT comment.*, user.name_user FROM comment
          INNER JOIN user ON comment.id_user = user.id_user
          WHERE comment.id_sp = $id_sp
          ORDER BY comment.id_cmt ASC";
          $queryComment = mysqli_query($conn, $sqlComment);
          $totalCom = mysqli_num_rows($queryComment);
          if($totalCom > 0){
      ?>
        <!-- <h3>REVIEWS</h3> -->

        <div class="comment-container">
    <?php while($row = mysqli_fetch_array($queryComment)) { ?>
        <div class="comment">
            <img src="https://png.pngtree.com/png-clipart/20190904/original/pngtree-user-cartoon-girl-avatar-png-image_4492903.jpg" style="height: 50px; width: 50px;" alt="">
            <p style="font-size: 16px; padding-top: 15px; display:block "><?php echo $row['name_user']; ?></p>
            <p style="padding-top: 35px;display:block "><?php echo $row['noidung']; ?></p>
            <p style="font-size: 9px; color: #666666; padding-top:42px; padding-left:20px;"><?php echo date('Y-m-d', strtotime($row['ngay_gio'])); ?></p>
        </div>
    <?php } ?>
</div>

<?php } ?>
        <!-- bình luận -->

        <?php
          if(isset($_POST['submit'])){
            $noidung = $_POST['noidung'];
            //xử lí thêm ngày giờ
            $ngay_gio = date("Y-m-d H:i:s");
            if(isset($noidung)){
              $sql = "INSERT INTO comment (id_user, noidung, ngay_gio, id_sp) VALUES ('$id_user', '$noidung', '$ngay_gio', '$id_sp')";
              $query = mysqli_query($conn,$sql);
              header ('location: product-detail.php?id_sp='.$id_sp);
            }
          }
        ?>
        <div class="comment-form">
    <form action="product-detail.php?id_sp=<?php echo $id_sp?>" method="post">
        <!-- ... -->
          <div style="display:flex;">
          <img src="https://png.pngtree.com/png-clipart/20190904/original/pngtree-user-cartoon-girl-avatar-png-image_4492903.jpg" style="height:50px; width:50px;" alt="">
          
          <p style="font-size:16px;  padding-top:15px; ">
          <?php if (isset($_SESSION['name_user']) && ($_SESSION['name_user'] != "")) : ?>
                <?php echo $_SESSION['name_user']; ?>
        <?php endif; ?> </p>
          </div>

          <textarea name="noidung" id="" cols="60" rows="8" style= "padding:10px; font-size:15px;" required="" placeholder="Your comment.."></textarea><br><br>
          <button name="submit" style="height:35px; width:120px; background-color:black; border-radius: 8px;border-color: black; color: white; font-size: 19px;" >Comment</button>
          </form>
        </div>
        
      </section>
    </main>
  </body>
  <style>
    .comment-container {
        display: flex;
        flex-direction: column;
        margin-left: 100px; /* Khoảng cách từ bên trái */
        margin-top: -35%; /* Khoảng cách từ phía trên */
        width:700px;
    }

    .comment {
        display: flex;
        margin-bottom: 20px; /* Khoảng cách giữa các bình luận */
    }
    .comment p {
        font-size: 17px;
        color: #666666;
        white-space: pre-line;
    }
    .comment-form {
        margin-left: 150px; /* Khoảng cách từ bên trái */
        display: flex;
        flex-direction: column;
        margin-top: 5%; /* Khoảng cách từ phía trên */
    }
</style>

<!-- FOOTER -->
<?php require_once 'include/footer.php';
        ?>

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
                $('#js-cart-list').show();
            }
        });


    });
</script>
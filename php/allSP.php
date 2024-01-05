<?php
include "../admin/config/dbconnect.php";
require "include/header.php";
$id_sp = $_GET['id_sp'];
$id_dm = $_POST['id_dm'];

$sql_dm = "SELECT DISTINCT id_dm, name_dm FROM danhmuc;";
$query_dm = mysqli_query($conn, $sql_dm);
$row_dm = mysqli_fetch_array($query_dm);


$sql_sp = "select * from sanpham where id_sp ='$id_sp' ";
$query_sp = mysqli_query($conn, $sql_sp);
$row_sp = mysqli_fetch_array($query_sp);

?>
<br><br><br><br>
<section class="new-product" data-query="1"  style="display:flex;justify-content:center; align-items:center; flex-direction:column">
        <!-- <div class="center-text">
            <h3> Sản Phẩm Mới</h3>
        </div> -->
        <div class="navbar" style="color: #000;justify-content:left;">
    <?php
    // Assume $conn is your database connection
    $categorySql = "SELECT * FROM danhmuc";
    $categoryResult = mysqli_query($conn, $categorySql);
    echo "<a href='#' style='padding:6px 12px;border-radius:12px; font-size: 18px;  font-stretch: ultra-expanded; letter-spacing: 3px;' class='category-link' data-category-id='0'>Tất cả</a>";

    while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
        echo "<a href='#' style='padding:6px 12px;border-radius:5px;font-size: 18px;letter-spacing: 3px; font-stretch: ultra-expanded; ' class='category-link' data-category-id='{$categoryRow['id_dm']}'>{$categoryRow['name_dm']}</a>";
    }
    ?>
</div><br>


        <div class="new-content" id="productContainer">
        <?php 
            //phân trang sp
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
            $page = 1;
            }
            $rowPerPage =8;
            $perRow = $page*$rowPerPage-$rowPerPage;  
        
            $sql = "select * from sanpham limit $perRow, $rowPerPage";
            $query = mysqli_query($conn, $sql);
            $result = $conn->query($sql);

            $totalRow = mysqli_num_rows(mysqli_query($conn, "SELECT * from sanpham"));
            $totalPage = ceil($totalRow/$rowPerPage);
            $listPage = "";
            for($i=1; $i<=$totalPage; $i++){
                if($page==$i){
                $listPage.='<li class="page-item active"><a href="allSP.php?page='.$i.'" class="page-link" >'.$i.' <span class="sr-only">(current)</span></a></li>';
                }else{
                $listPage .='<li class="page-item"><a href="allSP.php?page='.$i.'" class="page-link">'.$i.'</a></li>';
                }
            }


            $count=1;

            if ($result->num_rows > 0){
                while($row = mysqli_fetch_array($query)){?>
                        <div class="row">
                        <a href="product-detail.php?id_sp=<?= $row['id_sp']?>"><img style="width:100%" src="../admin/img/<?= $row['anh_mota'] ?>" alt="" > </a>
                            <h4 style="width:100%"><?= $row['ten_sp'] ?></h4>
                            <h5 style="width:100%; margin-bottom:10px;">$<?= $row['gia_sp'] ?></h5>
                        <!-- <div class="top">
                            <p>Hot</p>
                        </div> -->

                        <div class="bbtn">
                            <a href="#" class="js-add-cart">ADD TO CART</a>
                        </div>            
                    </div>

        <?php
            $count=$count+1;
      }
    }?>
    <ul class="pagination" style="float:right; margin-right: 150px;">
                      <!-- <li class="page-item"><a href="" class="page-link">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
                      <?php
                      echo $listPage;
                      ?>
                </ul>

            </div>
            
    </section>




    <script>
    $(document).ready(function() {
        $(".category-link").click(function(e) {
            e.preventDefault();
            var categoryId = $(this).data("category-id");
            if(categoryId == 0){
                categoryId = '-1';
            }
            let $container = $(this).closest('.new-product').data("query");
            if($container == 1){
                $("#productContainer").addClass("fade");
            }else{
                $("#productContainer2").addClass("fade");
            }

            $.ajax({
                type: "POST",
                url: "get_products_by_category.php",
                data: { 
                    category_id: categoryId,
                    type: $container
                },
                success: function(response) {
                    if($container == 1){
                        $("#productContainer").html(response);
                        setTimeout(function() {
                            $("#productContainer").removeClass("fade");
                        }, 600);
                    }else{
                        $("#productContainer2").html(response);
                        setTimeout(function() {
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
navbarLinks.forEach(function(link) {
    link.addEventListener('click', function() {
        // Loại bỏ lớp active từ tất cả các liên kết
        navbarLinks.forEach(function(innerLink) {
            innerLink.classList.remove('active');
        });

        // Thêm lớp active cho liên kết được nhấn vào
        link.classList.add('active');
    });
});

        
    </script>
    
    <?php require_once 'include/footer.php';

        ?>
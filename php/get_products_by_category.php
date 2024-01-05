<?php
include "../admin/config/dbconnect.php";

if (isset($_POST['category_id']) && !empty($_POST['category_id'])) {
    $category_id = $_POST['category_id'];
    $type = $_POST['type'];

    $productSql = "SELECT * FROM sanpham";
    if ($category_id != '-1') {
        $productSql .= " WHERE id_dm = $category_id";
    }

    $productResult = mysqli_query($conn, $productSql);

    if ($productResult) {
        while ($productRow = mysqli_fetch_assoc($productResult)) {
            echo "<div class='row'>";
            echo "<a href='product-detail.php?id_sp={$productRow['id_sp']}'>";
            echo "<img src='../admin/img/{$productRow['anh_mota']}' alt=''>";
            echo "</a>";
            echo "<h4>{$productRow['ten_sp']}</h4>";
            echo "<br><h5>$ {$productRow['gia_sp']}</h5>";

            echo "<div class='bbtn'>";
            echo "<a href='#' class='js-add-cart'>ADD TO CART</a>";
            echo "</div>";

            echo "</div>";
        }
    } else {
        // Handle query error
        echo "Error fetching products: " . mysqli_error($conn);
    }
} else {
    // Handle invalid category_id
    echo "Invalid category ID";
}
?>

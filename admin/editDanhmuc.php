<?php
// ob_start();

include_once './includes/header.php';
include_once './includes/navbar.php';

require_once './config/dbconnect.php';

$id_dm = $_GET['id_dm'];
$sql = "select * from danhmuc where id_dm ='$id_dm' ";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);

if(isset($_POST['submit'])) {
    $name_dm = $_POST['name_dm'];
    
    // Kiểm tra giá trị của $id_dm
    if(isset($name_dm)) {
        $update ="UPDATE danhmuc SET name_dm = '$name_dm' WHERE id_dm = '$id_dm'";
        $query_update= mysqli_query($conn, $update);
        if(!$query_update) {
              // echo mysqli_error($conn);
            header("Location: addDanhmuc.php?category=error");
        } else {
            echo "Cập nhật thành công.";
            // header("Location: addDanhmuc.php?category=success");
            echo "<script> window.location.href='addDanhmuc.php?category=success' </script>";
        }
    }   
}
    
// ob_end_flush();

    ?>

<body>
    
<div style="width:70%; margin-left:15%;">

        <div class="modal-header" >
          <h2 class="modal-title">Chỉnh sửa danh mục</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
        
          <form  enctype='multipart/form-data' method="POST" ation="">
            <div class="form-group">
              <label for="c_name" style="font-size:20px;">Tên danh mục:</label>
              <input type="text" class="form-control" name="name_dm" style="font-size:20px;" value="<?= $row['name_dm'] ?>" >
            </div>

            <div class="modal-footer">
        <button type="submit" class="btn btn-warning" name="submit">Lưu</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal" style="height:40px" onclick="closeModal()">Đóng</button>
        </div>
          </form>
   
        </div>
        <!-- <div class="form-group">
            <button type="submit" class="btn btn-warning" name="save" data-toggle="modal" data-target="#myModal">Lưu</button>
            </div> -->

      </div>
    



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script>
    
    function closeModal() {
        $("#myModal, #editModal").modal('hide');
    }



</script> -->

<?php
include_once './includes/footer.php';
?>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
</body>

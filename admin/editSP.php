<?php
include_once './includes/header.php';
include_once './includes/navbar.php';

require_once './config/dbconnect.php';

$id_sp = $_GET['id_sp'];


$sql_dm = "SELECT DISTINCT id_dm, name_dm FROM danhmuc;";
$query_dm = mysqli_query($conn, $sql_dm);
$row_dm = mysqli_fetch_array($query_dm);



$sql_sp = "select * from sanpham where id_sp ='$id_sp' ";
$query_sp = mysqli_query($conn, $sql_sp);
$row_sp = mysqli_fetch_array($query_sp);
if(isset($_POST['submitt'])){
    $name_sp = $_POST['name_sp'];
    $id_dm = $_POST['id_dm'];
    $gia = $_POST['gia'];
    $chitiet_sp = $_POST['chitiet_sp'];

    if($_FILES['anh_mota']['name']==""){
      $anh_sp = $_POST['anh_mota'];
    }else{
      $anh_sp = $_FILES['anh_mota']['name'];
      $tmp_name = $_FILES['anh_mota']['tmp_name'];
    }

    $id_dm = $_POST['id_dm'];

    if(isset($name_sp) && isset($gia) && isset($chitiet_sp)) {
      move_uploaded_file($tmp_name, 'img/'.$anh_sp);
      $sql = "UPDATE sanpham set ten_sp = '$name_sp', gia_sp = '$gia', anh_mota='$anh_sp', chitiet_sp='$chitiet_sp' ,id_dm = '$id_dm' where id_sp = '$id_sp'";
      $query = mysqli_query($conn, $sql);
      // header('location: addSanPham.php');
      if(!$query) {
        // echo mysqli_error($conn);
        header("Location: addSanPham.php?category=error");
    } else {
        // echo "Cập nhật thành công.";
        echo "<script> window.location.href='addSanPham.php?category=success' </script>";
      }
    }
}?>
<div class="modal-content" style="width:70%; margin-left:15%; top:.2%;">
        <div class="modal-header">
          <h4 class="modal-title">Edit</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="color:black;">
          <form  enctype='multipart/form-data'  action="" method="POST">
            <div class="form-group">
              <label for="c_name" >Product name:</label>
              <input type="text" class="form-control" name="name_sp" required value="<?php if(isset($_POST['name_sp'])){ echo $_POST['name_sp'];} else{ echo $row_sp['ten_sp'];}?>">
              <label for="dm">Phân loại:</label><br>
              <select name="id_dm" class="form-control">
                <!-- <option value="unselect" selected>Lựa chọn danh mục</option> -->
                <?php
                while($row_dm = mysqli_fetch_array($query_dm)){?>
                <option
                    <?php
                        if($row_sp['id_dm'] == $row_dm['id_dm']){
                            echo 'selected= "selected"';       
                        }?>
                value="<?=$row_dm['id_dm'];?>"> <?=$row_dm['name_dm'];?>
            </option> 
                <?php }?>
              </select>

              <label for="gia" >Price:</label>
              <input type="number" class="form-control" name="gia" required value="<?php if(isset($_POST['gia_sp'])){ echo $_POST['gia_sp'];} else{ echo $row_sp['gia_sp'];}?>">
              <label for="chitiet">Product detail:</label><br>
              <textarea name="chitiet_sp" id="" cols="50" rows="4" class="form-control" value=""><?php if(isset($_POST['chitiet_sp'])){ echo $_POST['chitiet_sp'];} else{ echo $row_sp['chitiet_sp'];}?></textarea>
              
              <label for="c_name" >Descriptive image:</label>
              <input type="file" class="form-control" name="anh_mota" required value="<?=$row_sp['anh_mota']?>">
              <input type="hidden" name="anh_mota" value="<?=$row_sp['anh_mota']?>">
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-success" name="submitt" style="height:40px;" >Update</button>

            <!-- <div class="modal-footer"> -->
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal" style="height:40px; float: right;" onclick="close()">Đóng</button> -->
        <!-- </div> -->
            </div>
          </form>

        </div>
        
      </div>
      
    </div>
  </div>
  <script>
        function close() {
            window.location.href = 'addSanPham.php'; 
        }
    </script>
  
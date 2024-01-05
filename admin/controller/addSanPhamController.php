<?php
    include_once "../config/dbconnect.php";
    
    


if(isset($_POST['submitt'])){
    $name_sp = $_POST['name_sp'];
    $id_dm = $_POST['id_dm'];
    $gia = $_POST['gia'];
    $chitiet_sp = $_POST['chitiet_sp'];

  
    //$_Files là 1 biến siêu toàn cục lấy thông tin từ tệp tải lên qua form 
    // $anh_mota = $_FILES['anh_mota']['name'];: Lấy tên của tệp tin được chọn và 
    // gán cho biến $anh_mota. Tên tệp tin được lưu trong thuộc tính 'name' của mảng $_FILES.
  
    if($_FILES['anh_mota']['name']==''){
      $error_anh_mota = '<span style="color:red">(*)</span>';
    }else{
      $anh_mota = $_FILES['anh_mota']['name'];
      $tmp_name = $_FILES['anh_mota']['tmp_name'];
    }
  
    if($_POST['id_dm']==''){
      $error_id_dm = '<span style="color:red">(*)</span>';
    }else{
      $id_dm = $_POST['id_dm'];
    }
    if(isset($name_sp) && isset($gia) && isset($anh_mota) && isset($id_dm)){
      move_uploaded_file($tmp_name, 'img/'.$anh_mota);
    $sql_sp = "INSERT INTO sanpham(ten_sp, gia_sp, anh_mota, id_dm, chitiet_sp) value ('$name_sp', '$gia', '$anh_mota', $id_dm, '$chitiet_sp')";
    $query_sp = mysqli_query($conn, $sql_sp);

    if(!$query_sp)
         {
             echo mysqli_error($conn);
             header("Location: ../addSanPham.php?category=error");
         }
         else
         {
          
             echo "Thêm thành công.";
             header("Location: ../addSanPham.php?category=success");
         }
  }


  }

?>
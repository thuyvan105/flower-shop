<?php
include_once './includes/header.php';
include_once './includes/navbar.php';

require_once './config/dbconnect.php';

if(isset($_POST['stext'])){
    $stext = $_POST['stext'];
}else{
    $stext = '';
}

//loại bỏ các khoảng trắng từ đầu và cuối của từ khóa
$newStext = str_replace(' ', '%', $stext);
$sql = "SELECT sanpham.*, danhmuc.name_dm 
        FROM sanpham 
        JOIN danhmuc ON sanpham.id_dm = danhmuc.id_dm 
        WHERE sanpham.ten_sp LIKE '%$newStext%' OR danhmuc.name_dm LIKE '%$newStext%'";
$query = mysqli_query($conn, $sql);

?>

<p style="margin-left:25px;">Search Results:  <?php echo $stext ?></p> 
<div style="overflow-x:auto; ">
<table class="table table-hover" style="width:80%; margin-left: 10%; margin-top:0.5%;   text-align: center;">
  <thead>
    
    <tr style = "background-color: #a05099; color:white; margin-left:500px;">
    <th scope="col">Product Name</th>
      <th scope="col">Price</th>
      <th scope="col">Classification</th>
      <th scope="col">Description image </th>
      <th scope="col">Product details </th>

<th scope="col">Edit </th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php
    if ($result-> num_rows > 0){
        while($row = mysqli_fetch_array($query)){
      ?>
  <tr>
      <th style="font-size:18px; text-transform: capitalize;"><?= $row['ten_sp'] ?> </th>
      <!-- <td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal" Chỉnh sửa</button> -->

      <td style="font-size:18px; text-transform: capitalize;">$<?= $row['gia_sp'] ?> </td>
      <td style="font-size:18px; text-transform: capitalize;"> <?= $row['name_dm'] ?> </td>
      <th> <img src="img/<?= $row['anh_mota'] ?>" alt="" style ="width:80px; height:80px;">  </th>
      <td style="font-size:18px;"><?= $row['chitiet_sp'] ?> </td>


      <td> 
        <!-- <button type="button" class="btn btn-warning" style="margin-left:15%" data-toggle="modal" data-target="#editModal" onclick="editDanhmuc(')">Chỉnh sửa</button> -->
        <a href="editSP.php?id_sp=<?= $row['id_sp'] ?>"><i class="fa-regular fa-pen-to-square" style="font-size: 20px; color:#6786db; "></i></a>
      <!-- <button type="button" class="btn btn-danger">Xóa</button> -->
</td>
    <td>
      <a href="javascript:void(0);" onclick="confirmDelete(<?=$row['id_sp']?>)"><i class="fa-regular fa-circle-xmark" style="font-size:20px; color:red;"></i></a>
    </td>
    </tr>
    <?php
      }
    }
    ?>
  </tbody>
</table>